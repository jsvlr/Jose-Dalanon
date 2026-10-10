<?php

use App\Livewire\About;
use App\Livewire\Blog\BlogIndex;
use App\Livewire\Blog\BlogShow;
use App\Livewire\Homepage;
use App\Livewire\Project\ProjectIndex;
use App\Livewire\Project\ProjectShow;
use App\Livewire\Stack;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/stack', Stack::class)->name('stack.index');

Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('/', BlogIndex::class)->name('index');
    Route::get('/{post:slug}', BlogShow::class)->name('show');
});

Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', ProjectIndex::class)->name('index');
    Route::get('/{project:slug}', ProjectShow::class)->name('show');
});
