<?php

use App\Http\Controllers\PageController;
use App\Livewire\Pages\CategoryListing;
use App\Livewire\Pages\Contact;
use App\Livewire\Pages\HomePage;
use App\Livewire\Pages\SinglePost;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/category/{slug}', CategoryListing::class)->name('category.listing');
Route::get('/post/{slug}', SinglePost::class)->name('post.single');

// Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy.page');
Route::get('/terms_conditions', [PageController::class, 'termsConditions'])->name('terms.page');
Route::get('/contact', Contact::class)->name('contact.page');

