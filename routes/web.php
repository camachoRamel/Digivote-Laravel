<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\LoginLogoutController;
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
Route::get('/', function () {
    return view('pages.login');
})->name('index');

Route::post('/login', [LoginLogoutController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginLogoutController::class, 'logout'])->name('logout');


Route::middleware('isadmin')->group(function () {
    Route::get('/admin', [CandidateController::class, 'index'])->name('admin.index');
});
// create
Route::get('/admin/party-add-candidate', function () {
    return view('pages.admin.party-add-candidate');
})->name('admin.party-add-candidate');

Route::get('/admin/position-add-candidate', function () {
    return view('pages.admin.position-add-candidate');
})->name('admin.position-add-candidate');

Route::post('admin/candidate-save', [CandidateController::class, 'saveCandidate'])->name('candidate.save');

// read
Route::get('/admin/candidate-view/{candidate_id}', [CandidateController::class, 'getCandidate'])->name('candidate.view');

// update
Route::get('/admin/candidate-edit/{candidate_id}', [CandidateController::class, 'editCandidate'])->name('candidate.edit');
Route::post('/admin/candidate-update/{candidate_id}', [CandidateController::class, 'updateCandidate'])->name('candidate.update');

// delete
Route::post('/admin/candidate-delete/{candidate_id}', [CandidateController::class, 'deleteCandidate'])->name('candidate.delete');

// display
Route::get('/admin/candidate-poll', [CandidateController::class, 'displayPoll'])->name('candidate.poll');
Route::get('/admin/candidate-list', [CandidateController::class, 'displayCandidates'])->name('candidate.list');
Route::get('/admin/voters', [CandidateController::class, 'displayVoters'])->name('voters');

Route::get('/log', [UserController::class, 'index'])->name('user.login');

Route::get('/', function () {
    return view('pages.login');
});

Route::get('/user', [CandidateController::class, 'displayBallotSheet'])->name('user.index');
