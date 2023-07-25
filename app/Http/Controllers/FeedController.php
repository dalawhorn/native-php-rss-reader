<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Native\Laravel\Dialog;
use App\Models\Feed;

class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $view_data = [];
        $view_data['feeds'] = Feed::all();
        $view_data['selected_feed'] = collect([]);

        if($request->filled('selected_feed')) {
            $view_data['selected_feed'] = Feed::find($request->get($request->get('selected_feed')));
        }

        return view('index', $view_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}