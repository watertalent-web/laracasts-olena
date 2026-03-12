<?php

use App\Models\Idea;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $ideas = Idea::all();

    return view('welcome', [
        'greeting' => 'Whai is up Laracasts?',
        'name' => request('person', 'World'),
        'ideas' => session('ideas', $ideas),
    ]);
});

Route::view('/about', 'about');

Route::get('/contact', function () {
    $ideas = DB::table('ideas')->get();

    return view('contact', ['ideas' => $ideas]);
});

Route::post('/ideas', function () {
    $idea = request()->input('idea');

    Idea::create([
        'description' => $idea,
        'state' => 'pending',
    ]);

    return redirect('/');
});

// temporary
Route::get('/delete-ideas', function () {
    session()->forget('ideas');

    return redirect('/');
});
