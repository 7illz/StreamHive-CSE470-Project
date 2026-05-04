<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Movie;
use App\Models\Series;
use App\Models\Watchlist;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function fetchUsers(){
        $records = User::all();
        return view('admin', compact('records'));
    }

    public function fetchMovies(){
        $records = Movie::all();
        return view('admin_movies', compact('records'));
    }

    public function fetchSeries(){
        $records = Series::all();
        return view('admin_series', compact('records'));
    }

    public function fetchWatchlist(){
        $records = Watchlist::all();
        return view('admin_watchlist', compact('records'));
    }
    public function fetchSubscription(){
        $records = Subscription::all();
        return view('admin_subscription', compact('records'));
    }

    public function admin_go(Request $request){
        $incoming_fields=$request->validate([
            'decision' => 'required',
        ]);
        if($incoming_fields['decision']=='user'){
            return redirect('/admin');
        }
        else if($incoming_fields['decision']=='subscription'){
            return redirect('/admin_subscription');
        }
        else if($incoming_fields['decision']=='movies'){
            return redirect('/admin_movies');
        }
        else if($incoming_fields['decision']=='series'){
            return redirect('/admin_series');
        }
        elseif($incoming_fields['decision']=='watchlist'){
            return redirect('/admin_watchlist');
        }
        else{
            return redirect()->back()->with('message', 'Invalid Decision');
        }
    }

    public function admin_assign_role(Request $request){
        $incoming_fields = $request->validate([
            'id' => 'required|exists:users,id', 
            'status' => 'required|in:user,admin', 
        ]);
    
        $user = User::find($incoming_fields['id']);
        if ($user) {
            $user->role = $incoming_fields['status']; 
            $user->save();
            return redirect('/admin')->with('message', 'User Role Updated Successfully');
        } else {
            return redirect('/admin')->with('message', 'User Not Found');
        }
    }

    public function admin_change_status(Request $request){
        $incoming_fields = $request->validate([
            'payment_date' => 'required|date',
            'expiry_date' => 'required|date|after_or_equal:payment_date',
            'users_id' => 'required|exists:subscription,users_id', 
            'status' => 'required|in:free,individual,family', 
        ]);
    
        $subscription = Subscription::where('users_id', $incoming_fields['users_id'])->first();
        if ($subscription) {
            $subscription->status = $incoming_fields['status']; 
            $subscription->payment_date = $incoming_fields['payment_date'];
            $subscription->expiry_date = $incoming_fields['expiry_date'];
            $subscription->save();
            return redirect('/admin_subscription')->with('message', 'Subscription Status Updated Successfully');
        } else {
            return redirect('/admin_subscription')->with('message', 'Subscription Not Found');
        }
    }
    
    public function addmovie(Request $request){
        $incoming_fields = $request->validate([
            'id' => 'required',
            'm_name' => 'required',
            'm_description' => 'required',
            'img_url' => 'required|file|mimes:jpg,jpeg,png|max:2048', 
            'liked' => 'required|integer|min:0',
        ]);

        $movie_name=$request->file('img_url')->getClientOriginalName();
        $image_path='images/'.$movie_name;
    
        Movie::create([
            'id' => $incoming_fields['id'],
            'm_name' => $incoming_fields['m_name'],
            'm_description' => $incoming_fields['m_description'],
            'img' => $image_path,
            'liked' => $incoming_fields['liked'],
        ]);
    
        return redirect('/admin_movies')->with('message', 'Movie Added Successfully');
    }

    public function addseries(Request $request){
        $incoming_fields=$request->validate([
            'id'=>'required',
            's_name'=>'required',
            's_description'=>'required',
            'img_url' => 'required|file|mimes:jpg,jpeg,png|max:2048', 
            'liked' => 'required|integer|min:0',
        ]);

        $series_name=$request->file('img_url')->getClientOriginalName();
        $image_path='images/'.$series_name;

        Series::create([
            'id'=>$incoming_fields['id'],
            's_name'=>$incoming_fields['s_name'],
            's_description'=>$incoming_fields['s_description'],
            'img'=>$image_path,
            'liked'=>$incoming_fields['liked'],
        ]);
        return redirect('/admin_series')->with('message', 'Series Added Successfully');
    }

    public function deleteuser($id){
        Subscription::where('users_id', $id)->delete();
        
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('/admin')->with('message', 'User Deleted Successfully');
        } else {
            return redirect('/admin')->with('message', 'User Not Found');
        }
    }

    public function deletemovie($id){
        $movie = Movie::find($id);
        if ($movie) {
            $movie->delete();
            return redirect('/admin_movies')->with('message', 'Movie Deleted Successfully');
        } else {
            return redirect('/admin_movies')->with('message', 'Movie Not Found');
        }
    }

    public function deleteseries($id){
        $series = Series::find($id);
        if ($series) {
            $series->delete();
            return redirect('/admin_series')->with('message', 'Series Deleted Successfully');
        } else {
            return redirect('/admin_series')->with('message', 'Series Not Found');
        }
    }

    public function liked(Request $request){
        $incoming_fields=$request->validate([
            'type'=>'required|in:movie,series',
            'name'=>'required',
            'liked'=>'required',
        ]);

        if ($incoming_fields['type'] == 'movie') {
            $movie = Movie::where('m_name', $incoming_fields['name'])->first();
            if ($movie) {
                $movie->liked = $movie->liked + 1; 
                $movie->save();
                return redirect()->back()->with('message', 'Movie Liked Successfully');
            } else {
                return redirect()->back()->with('message', 'Movie Not Found');
            }
        }
        elseif ($incoming_fields['type'] == 'series') {
            $series = Series::where('s_name', $incoming_fields['name'])->first();
            if ($series) {
                $series->liked = $series->liked + 1; 
                $series->save();
                return redirect()->back()->with('message', 'Series Liked Successfully');
            } else {
                return redirect()->back()->with('message', 'Series Not Found');
            }
        } else {
            return redirect()->back()->with('message', 'Invalid Type');
        }
    }
}
