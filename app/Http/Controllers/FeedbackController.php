<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'user_id' => \Illuminate\Support\Facades\Auth::user()->id, // This will always work if the user is logged in
            'rating' => $request->input('rating'),
            'comments' => $request->input('comments'),
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback!');
    }

    public function showFeedbackForm()
    {
        // Calculate the average rating
        $averageRating = Feedback::avg('rating');

        // Pass the average rating to the view
        return view('feedback', ['averageRating' => $averageRating]);
    }
}
?>