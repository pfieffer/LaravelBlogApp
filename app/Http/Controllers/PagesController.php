<?php

namespace App\Http\Controllers;

class PagesController extends Controller
{
    public function index()
    {
        $title = 'Welcome to Laravel Blog Site';
        //return view('pages.index', compact($title));
        return view('pages.index')->with('title', $title);
    }

    public function about()
    {
        $title = 'About us';
        return view('pages.about')->with('title', $title);
    }

    public function services()
    {
        $data = array(
            'title' => 'Services', 'services' => ['Web Design', 'Software Development', 'Graphics Design']
        );
        return view('pages.services')->with($data);

    }
}
