<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
    return Inertia::render('Chat/index');
})->name('chat');

Route::middleware(['auth:sanctum'])->get('/chat/rooms', [ChatController::class, 'rooms'])->name('rooms');
Route::middleware(['auth:sanctum'])->get('/chat/room/{roomid}/messages', [ChatController::class, 'messages'])->name('messages');
Route::middleware(['auth:sanctum'])->post('/chat/room/{roomid}/newMessage', [ChatController::class, 'newMessage'])->name('new_message');


