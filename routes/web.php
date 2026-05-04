<?php

use App\Models\Series;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ContentManagerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/signup',function(){
    return view('signup');
})->name('signup'); //using this cos we are using route helper instead of directly giving url in form like action="/login"

Route::get('/login',function(){
    return view('login');
})->name('login'); //using this cos we are using route helper instead of directly giving url in form like action="/login"

Route::get('/watchlist',function(){
    return view('watchlist');
})->name('watchlist'); 

Route::get('/UI',function(){
    return view('UI');
})->name('UI');

Route::get('/subscription',function(){
    return view('subscription');
})->name('subscription');

Route::get('/payment',function(){
    return view('payment');
})->middleware('auth');

Route::get('/movies',function(){
    return view('movies');
})->name('movies');

Route::get('/series',function(){
    return view('series');
})->name('series');

Route::get('/choose_content',function(){
    return view('choose_content');
})->name('choose_content');

Route::get('/playcontent',function(){
    return view('playcontent');
})->name('playcontent');

Route::get('/decisionpage', function(){
    return view('decisionpage');
})->name('decisionpage')->middleware('auth');

Route::get('/admin',function(){
    return view('admin');
})->middleware('auth');

Route::get('/admin_movies',function(){
    return view('admin_movies');
})->middleware('auth');

Route::get('/admin_series',function(){
    return view('admin_series');
})->middleware('auth');

Route::get('/admin_watchlist',function(){
    return view('admin_watchlist');
})->middleware('auth');

Route::get('/admin_subscription',function(){
    return view('admin_subscription');
})->middleware('auth');

Route::get('/UI', [UserController::class, 'index'])->name('UI');

Route::get('/watchlist', [WatchlistController::class, 'fetchmovies'])->name('watchlist'); //pt1
Route::get('/fetchmovies',[WatchlistController::class,'fetchmovies'])->name('fetchmovies');//pt2

Route::get('/admin',[AdminController::class,'fetchUsers'])->name('fetchUsers')->middleware('auth');

Route::get('/admin_subscription',[AdminController::class,'fetchSubscription'])->name('fetchSubscription')->middleware('auth');
Route::get('/admin_movies',[AdminController::class,'fetchMovies'])->name('fetchMovies')->middleware('auth');
Route::get('/admin_series',[AdminController::class,'fetchSeries'])->name('fetchSeries')->middleware('auth');
Route::get('/admin_watchlist',[AdminController::class,'fetchWatchlist'])->name('fetchWatchlist')->middleware('auth');

Route::get('/movies',[MoviesController::class,'fetchmovies'])->name('movies');
Route::get('/series',[SeriesController::class,'fetchseries'])->name('series');

Route::get('/search',[UserController::class,'search'])->name('search');

Route::post('/login',[UserController::class,'login'])->name('login');

Route::post('/signup',[UserController::class,'signup'])->name('signup');

Route::post('/logout',[UserController::class,'logout'])->name('logout');

Route::post('/addwatchlist',[WatchlistController::class,'addwatchlist'])->name('addwatchlist');

Route::post('/decision', [UserController::class, 'decision'])->name('decision')->middleware('auth');

Route::post('/admin_go',[AdminController::class,'admin_go'])->name('admin_go');

Route::post('/addmovie',[AdminController::class,'addmovie'])->name('addmovie'); 
Route::post('/addseries',[AdminController::class,'addseries'])->name('addseries');

Route::post('/access_content',[ContentManagerController::class,'access_content'])->name('access_content');
Route::post('/gowatch',[ContentManagerController::class,'gowatch'])->name('gowatch');
Route::post('/payment',[SubscriptionController::class,'payment'])->name('payment');

Route::put('/subscription', [SubscriptionController::class, 'subscription'])->name('subscription');
Route::put('liked',[AdminController::class,'liked'])->name('liked');

Route::put('/admin_assign_role',[AdminController::class,'admin_assign_role'])->name('admin_assign_role');
Route::put('/admin_change_status',[AdminController::class,'admin_change_status'])->name('admin_change_status');

Route::delete('deletemovie/{id}',[AdminController::class,'deletemovie'])->name('deletemovie');
Route::delete('deleteseries/{id}',[AdminController::class,'deleteseries'])->name('deleteseries');
Route::delete('deleteuser/{id}',[AdminController::class,'deleteuser'])->name('deleteuser');



#SHATIL
Route::get('/feedback', [FeedbackController::class, 'showFeedbackForm'])->name('feedback');
Route::post('/store', [FeedbackController::class, 'store'])->name('store');


Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::delete('/watchlist/{id}', [WatchlistController::class, 'removeFromWatchlist'])->name('watchlist.remove');

Route::get('/generate-report', [PdfController::class, 'generateUserReport'])->name('generate.report');

// Mishal
// Route::get('/chat', [MessageController::class, 'index'])->name('chat');
// Route::get('/messages/{user}', [MessageController::class, 'getMessages']);
// Route::post('/messages', [App\Http\Controllers\MessageController::class, 'sendMessage']);
// Route::get('/messages/unread/count', [MessageController::class, 'getUnreadCount']);

Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [App\Http\Controllers\MessageController::class, 'index'])->name('chat');
    Route::post('/messages', [App\Http\Controllers\MessageController::class, 'sendMessage']);
    // This specific route must come AFTER any other /messages/* routes
    Route::get('/messages/unread/count', [App\Http\Controllers\MessageController::class, 'getUnreadCount']);
    Route::get('/messages/{user}', [App\Http\Controllers\MessageController::class, 'getMessages']);
});