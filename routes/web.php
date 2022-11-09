<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShowHideComponent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $time = json_encode([
            'time' => Carbon::now(),
            'user' => Auth::user()->id,
        ]);
        $key = base64_encode($time);
        return view('dashboard', ['key' => $key]);
    })->name('dashboard');
});


Route::get("/chamcong/{key}", [\Modules\TimeKeep\Http\Livewire\Timekeeps\Listing::class, 'store1'])->name('.store1');

Route::get('show',ShowHideComponent::class)->name('a');
