
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FriendshipController;



Route::get('/login', [AuthController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth')->name('profile');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Routes for Social Connection
Route::post('/friend-request/send', [FriendshipController::class, 'sendFriendRequest'])->middleware('auth');
Route::post('/friend-request/accept', [FriendshipController::class, 'acceptFriendRequest'])->middleware('auth');
Route::post('/friend-request/reject', [FriendshipController::class, 'rejectFriendRequest'])->middleware('auth');
Route::get('/friend-list', [FriendshipController::class, 'getFriendList'])->middleware('auth');

Route::get('/search-users', [FriendshipController::class, 'searchUsers'])->middleware('auth')->name('search-users');

Route::get('/friend-requests', [FriendshipController::class, 'showFriendRequests'])->middleware('auth')->name('friend-requests');
Route::get('/friend-list', [FriendshipController::class, 'showFriendList'])->middleware('auth')->name('friend-list');

Route::post('/send-friend-request', [FriendshipController::class, 'sendFriendRequest'])->name('send-friend-request');
Route::post('/accept-friend-request', [FriendshipController::class, 'acceptFriendRequest'])->name('accept-friend-request');
Route::post('/reject-friend-request', [FriendshipController::class, 'rejectFriendRequest'])->name('reject-friend-request');

// Route Message (Eunice)
use App\Http\Controllers\MessageController;

Route::middleware('auth')->group(function () {
    Route::get('messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
});

// routes/web.php (fanny)

Route::get('/feeds', [App\Http\Controllers\FeedController::class, 'index'])->name('feeds.index');
Route::post('/feeds', [App\Http\Controllers\FeedController::class, 'store'])->name('feeds.store');
Route::delete('/feeds/{feed}', [App\Http\Controllers\FeedController::class, 'destroy'])->name('feeds.destroy');

Route::post('/comments/{feed_id}', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

Route::post('/likes/{feed_id}', [App\Http\Controllers\LikeController::class, 'toggle'])->name('likes.toggle');

use App\Http\Controllers\FeedController;

Route::get('/feeds/create', [FeedController::class, 'create'])->name('feeds.create');

Route::get('/feeds/create', [FeedController::class, 'showCreateForm'])->name('feeds.create');
