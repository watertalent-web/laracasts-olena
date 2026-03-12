<?php

use App\Models\Idea;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//index
Route::get('/', function () {
    $ideas = Idea::all();

    return view('ideas.index', [
        'ideas' => session('ideas', $ideas),
    ]);
});

Route::post('/ideas', function () {
    $idea = request()->input('idea');

    Idea::create([
        'description' => $idea,
        'state' => 'pending',
    ]);

    return redirect('/');
});

//show
Route::get('/ideas/{idea}', function (Idea $idea) {
    return view('ideas.show', ['idea' => $idea]);
});

// edit 
Route::get('/ideas/{idea}/edit', function (Idea $idea) {
    return view('ideas.edit', ['idea' => $idea]);   
});

// update
Route::patch('/ideas/{idea}', function (Idea $idea) {
    $idea->update([
        'description' => request('idea'),
    ]);
    return redirect('/ideas/' . $idea->id);
});

// destroy
Route::delete('/ideas/{idea}', function (Idea $idea) {
    $idea->delete();
    return redirect('/');
});
