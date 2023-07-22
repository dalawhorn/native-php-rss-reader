<?php

use Illuminate\Support\Facades\Route;
use Native\Laravel\Dialog;

use App\Models\Feed;
use App\Models\Entry;
use Illuminate\Http\Request;

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
    $view_data = [];
    $view_data['feeds'] = Feed::all();
    return view('index', $view_data);
});

Route::get('/open', function() {
    $view_data = [];

    $file_path = Dialog::new()
        ->title('Select RSS Feed File.')
        ->filter('Feeds', ['xml'])
        ->asSheet()
        ->open();

    if($file_path == "") {
        return redirect('/');
    }

    $file = simplexml_load_file($file_path);
    
    $view_data['feed'] = [
        'title' => $file->title,
        'subtitle' => $file->subtitle
    ];

    $feed = Feed::updateOrCreate(
        ['path' => $file_path],
        ['title' => $file->title, 'subtitle' => $file->subtitle, 'feed_id' => $file->id]
    );

    return redirect('/');

    // foreach($file->entry as $entry) {
    //     $view_data['entries'][] = [
    //         'title' => $entry->title,
    //         'summary' => $entry->summary,
    //         'content' => $entry->content,
    //         'author' => [
    //             'name' => $entry->author->name
    //         ]
    //     ];
    // }
 
    // return view('feed', $view_data);
});

// Route::get('/delete-feed', function(Request $request) {
//     if($request->filled('feed_id')) {
//         $feed = Feed::find($request->get('feed_id'));
//         $feed->delete();
//     }
//     return redirect('/');
// });