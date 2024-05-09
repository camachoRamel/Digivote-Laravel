<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\UserController;
use App\Models\Candidate;
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

Route::get('/admin', [CandidateController::class, 'index'])->name('admin.index');

Route::get('/admin/party-add-candidate', function () {
    return view('pages.admin.party-add-candidate');
})->name('admin.party-add-candidate');

Route::get('/admin/position-add-candidate', function () {
    return view('pages.admin.position-add-candidate');
})->name('admin.position-add-candidate');

Route::post('admin/candidate-save', [CandidateController::class, 'saveCandidate'])->name('candidate.save');

Route::get('/admin/candidate-view/{candidate_id}', [CandidateController::class, 'getCandidate'])->name('candidate.view');

Route::get('/admin/candidate-edit/{candidate_id}', [CandidateController::class, 'editCandidate'])->name('candidate.edit');
Route::post('/admin/candidate-update/{candidate_id}', [CandidateController::class, 'updateCandidate'])->name('candidate.update');

Route::post('/admin/candidate-delete/{candidate_id}', [CandidateController::class, 'deleteCandidate'])->name('candidate.delete');

Route::get('/admin/candidate-list', function () {
    return view('pages.admin.candidate-list');
})->name('admin.candidate-list');

Route::get('/admin/voters', function () {
    return view('pages.admin.voters');
})->name('admin.voters');

Route::get('/admin/candidate-poll', function () {
    return view('pages.admin.candidate-poll');
})->name('admin.candidate-poll');

Route::get('/admin/candidate-edit', function () {
    return view('pages.admin.candidate-edit');
})->name('admin.candidate-edit');

Route::get('/log', [UserController::class, 'index'])->name('user.login');

Route::get('/', function () {
    return view('pages.login');
});
