<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', action: function () {
    return view('filament.pages.dashboard');
});
