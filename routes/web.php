
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendshipController;
use App\Http\Controllers\FeedController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Routes for Social Connection (zara)

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/search-users', [FriendshipController::class, 'searchUsers'])->name('search-users');

    Route::get('/friend-requests', [FriendshipController::class, 'showFriendRequests'])->name('friend-requests');
    Route::get('/friend-list', [FriendshipController::class, 'showFriendList'])->name('friend-list');

    Route::post('/send-friend-request', [FriendshipController::class, 'sendFriendRequest'])->name('send-friend-request');
    Route::post('/accept-friend-request', [FriendshipController::class, 'acceptFriendRequest'])->name('accept-friend-request');
    Route::post('/reject-friend-request', [FriendshipController::class, 'rejectFriendRequest'])->name('reject-friend-request');
});

// Route Message (Eunice)
use App\Http\Controllers\MessageController;

Route::middleware('auth')->group(function () {
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
});

// routes/web.php (fanny)

Route::get('/feeds', [FeedController::class, 'index'])->name('feeds.index');
Route::post('/feeds', [FeedController::class, 'store'])->name('feeds.store');
Route::delete('/feeds/{feed}', [FeedController::class, 'destroy'])->name('feeds.destroy');
Route::get('/feeds/create', [FeedController::class, 'showCreateForm'])->name('feeds.create');
Route::resource('feeds', FeedController::class);


// dina (like dan komen)

use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;

Route::middleware('auth')->group(function () {
    Route::post('feeds/{feed}/like', [LikeController::class, 'store'])->name('feeds.like');
    Route::post('feeds/{feed}/comment', [CommentController::class, 'store'])->name('feeds.comment');
});
