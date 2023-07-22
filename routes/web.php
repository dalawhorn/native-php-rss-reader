<?php

use Illuminate\Support\Facades\Route;
use Native\Laravel\Dialog;

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
    return view('index');
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

    foreach($file->entry as $entry) {
        $view_data['entries'][] = [
            'title' => $entry->title,
            'summary' => $entry->summary,
            'content' => $entry->content,
            'author' => [
                'name' => $entry->author->name
            ]
        ];
    }
 
    return view('feed', $view_data);
});