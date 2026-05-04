<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\URL;

class ContentManagerController extends Controller
{
    public function access_content(Request $request){
        $incoming_fields=$request->validate([
            'type'=>'required',
            'name'=>'required',
        ]);

        $age = auth()->user()->age;
        if ($age < 18) {
            return redirect()->back()->with('underage', true);
        }

        $subscription = Subscription::where('users_id', auth()->id())->first();
        if ($subscription && $subscription->status === 'free') {
            return redirect()->back()->with('free', true);
        }

        if ($incoming_fields['type']=='movie'){
            $type=$incoming_fields['type'];
            $name_n=$incoming_fields['name'];
            $series_path="fetchmovies/{$name_n}";
            $name=Storage::disk('s3')->files($series_path)[0]??null;
        
            return view('choose_content',compact('type','name_n','name'));
        }
        elseif($incoming_fields['type']=='series'){
            $type=$incoming_fields['type'];
            $name=$incoming_fields['name'];
            $series_path="fetchseries/{$name}";
            $episodes=Storage::disk('s3')->files($series_path);
            return view('choose_content',compact('type','name','episodes'));
        }
        else{
            return redirect()->back()->with('message', 'Invalid Decision');
        }
    }

    public function gowatch(Request $request){
        $incoming_fields = $request->validate([
            'name' => 'required',
            'type' => 'required',
        ]);

        $type = $incoming_fields['type'];
        $name = $incoming_fields['name'];
        $base_name = str_replace(' ', '_', pathinfo($name, PATHINFO_FILENAME));

        if ($type == 'movie') {
            $video_path = "{$name}"; 
            $subtitleUrl=asset("subtitles/movies/{$base_name}.vtt");
        }
        elseif ($type == 'series') {
            $video_path = "{$name}";
            $subtitleUrl=asset("subtitles/series/{$base_name}.vtt");
        } else {
            return redirect()->back()->with('message', 'Invalid content type');
        }

        if (Storage::disk('s3')->exists($video_path)) {
            $videoUrl = Storage::disk('s3')->temporaryUrl($video_path, now()->addMinutes(30));;

            return view('playcontent', compact('videoUrl', 'subtitleUrl'));
        } else {
            return redirect()->back()->with('message', "Video not found at path: {$video_path}");
        }
    }
}
