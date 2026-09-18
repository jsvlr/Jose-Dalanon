<?php

use App\Livewire\About;
use App\Livewire\Blog;
use App\Livewire\Homepage;
use App\Livewire\Projects;
use App\Livewire\Stack;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class)->name('home');
Route::get('/blogs', Blog::class)->name('blogs');
Route::get('/projects', Projects::class)->name('projects');
Route::get('/about', About::class)->name('about');
Route::get('/stack', Stack::class)->name('stack');
