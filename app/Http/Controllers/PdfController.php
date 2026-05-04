<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Watchlist;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

// Add to the top of PdfController.php


class PdfController extends Controller
{
public function generateUserReport()
    {   
        $current_time = now();
        $user = auth()->user();
        $login_time = $user->recent_login ? \Carbon\Carbon::parse($user->recent_login) : null;
        
        if ($login_time) {
            $sessionDuration = $login_time->diff($current_time);
            $sessionSeconds = ($sessionDuration->h * 3600) + ($sessionDuration->i * 60) + $sessionDuration->s;

            $existingUsageTime = \Carbon\Carbon::createFromFormat('H:i:s', $user->usage_time);
            $existingSeconds = ($existingUsageTime->hour * 3600) + ($existingUsageTime->minute * 60) + $existingUsageTime->second;

            $totalSeconds = $sessionSeconds + $existingSeconds;

            $hours = floor($totalSeconds / 3600);
            $minutes = floor(($totalSeconds % 3600) / 60);
            $seconds = $totalSeconds % 60;
            $totalUsageTime = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            $totalUsageTime = $user->usage_time;
        }

        $subscription = Subscription::where('users_id', $user->id)->first();
        $watchlist = Watchlist::where('users_id', $user->id)->get();
        
        $pdf = PDF::loadView('pdf.user_report', [
            'user' => $user,
            'subscription' => $subscription,
            'watchlist' => $watchlist,
            'generated_at' => now()->format('Y-m-d H:i:s'),
            'total_usage_time' => $totalUsageTime 
        ]);

        return $pdf->download('user_report.pdf');
    }
}