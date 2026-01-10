<?php

use App\Livewire\CreateRequest;
use App\Livewire\RequestList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/request/create', CreateRequest::class);
Route::get('/request', RequestList::class);