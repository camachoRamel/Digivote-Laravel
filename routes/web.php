<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/candidate-save', [CandidateController::class, 'saveCandidate'])->name('candidate.save');

Route::get('/admin', function () {
    return view('pages.admin.index');
})->name('admin.index');

Route::get('/admin/candidate-list', function () {
    return view('pages.admin.candidate-list');
})->name('admin.candidate-list');

Route::get('/admin/voters', function () {
    return view('pages.admin.voters');
})->name('admin.voters');

Route::get('/admin/candidate-poll', function () {
    return view('pages.admin.candidate-poll');
})->name('admin.candidate-poll');

Route::get('/admin/party-add-candidate', function () {
    return view('pages.admin.party-add-candidate');
})->name('admin.party-add-candidate');

Route::get('/admin/position-add-candidate', function () {
    return view('pages.admin.position-add-candidate');
})->name('admin.position-add-candidate');

Route::get('/admin/candidate-edit', function () {
    return view('pages.admin.candidate-edit');
})->name('admin.candidate-edit');

Route::get('/admin/candidate-view', function () {
    return view('pages.admin.candidate-view');
})->name('admin.candidate-view');

Route::get('/log', [UserController::class, 'index'])->name('user.login');

Route::get('/', function () {
    return view('pages.login');
});
