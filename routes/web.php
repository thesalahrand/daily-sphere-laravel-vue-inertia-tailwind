<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Trackers\TinyUrl\TinyUrlController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware(['auth', 'verified'])->group(function () {
  Route::inertia('/', 'Introduction')->name('introduction');
  Route::inertia('/attributions', 'Attributions')->name('attributions');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::prefix('trackers/')->name('trackers.')->group(function () {
    Route::get('tiny-urls/redirect/{tiny_url:tiny_url}', [TinyUrlController::class, 'redirect'])->name('tiny_urls.redirect');
    Route::resource('tiny-urls', TinyUrlController::class)->except(['show']);
  });
});

require __DIR__ . '/auth.php';
