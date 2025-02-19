<?php

use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Landing Page Route
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Movies Route (accessible only for authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/movies', [MovieController::class, 'movies'])->name('movies');
    Route::get('/tv-shows', [MovieController::class, 'tvShows'])->name('tvShows');
    Route::get('/search', [MovieController::class, 'search']);
    Route::get('/movie/{id}', [MovieController::class, 'movieDetails']);
    Route::get('/tv/{id}', [MovieController::class, 'tvDetails']);
    Route::get('/home', [MovieController::class, 'index'])->name('home'); // Home page
    Route::get('/stream/tv/{id}', [MovieController::class, 'getStreamingLink']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/watchlist/check/{tmdbId}', [WatchlistController::class, 'check'])->name('watchlist.check');
    Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist.index');
    Route::post('/watchlist', [WatchlistController::class, 'store'])->name('watchlist.store');
    Route::delete('/watchlist/{id}', [WatchlistController::class, 'destroy'])->name('watchlist.destroy');
    Route::post('/movie/{id}/comment', [MovieController::class, 'storeMovieComment'])->name('movie.comment');
    Route::post('/tv/{id}/comment', [MovieController::class, 'storeTVComment'])->name('tv.comment');
    Route::delete('/comment/{id}', [MovieController::class, 'deleteComment'])->name('comment.delete');



});

// Redirect Dashboard to Home
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// Logout Route
Route::post('/logout', function () {
    auth()->logout();
    return redirect()->route(route: 'landing');
})->name('logout');

// Include Breeze Auth Routes
require __DIR__ . '/auth.php';
