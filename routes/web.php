<?php

use Illuminate\Support\Facades\Route;


use App\Models\Feed;
use Illuminate\Http\Request;
use App\Http\Controllers\FeedController;

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

Route::get('/', [FeedController::class, 'index']);
Route::get('/open', [FeedController::class, 'create']);

// Route::get('/delete-feed', function(Request $request) {
//     if($request->filled('feed_id')) {
//         $feed = Feed::find($request->get('feed_id'));
//         $feed->delete();
//     }
//     return redirect('/');
// });