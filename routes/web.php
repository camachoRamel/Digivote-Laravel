<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginLogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoterController;
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
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot.index');
Route::get('/forgot-password/otp',[ForgotPasswordController::class, 'sendOTP'])->name('send.otp');
Route::post('/forgot-password/otp/cheking/{id}', [ForgotPasswordController::class, 'checkOTP'])->name('check.otp');

Route::get('/', function () {
    return view('pages.login');
})->name('index');

Route::post('/login', [LoginLogoutController::class, 'authenticate'])->name('login');
Route::post('/logout', [LoginLogoutController::class, 'logout'])->name('logout');


// ADMIN ROUTES
Route::middleware('is-admin')->group(function () {
    Route::get('/admin', [CandidateController::class, 'index'])->name('admin.index');
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

    Route::get('/admin/import-students', function() {
        return view('pages.admin.import-students');
    })->name('import.students');

    Route::post('/admin/user-create', [UserController::class, 'create'])->name('user.create');
});

// USER ROUTES
Route::middleware('is-user')->group(function () {
    Route::get('/verify{id}', [UserController::class, 'index'])->name('user.index');
    Route::get('/user', [CandidateController::class, 'displayBallotSheet'])->name('voter.index');
    Route::post('/create-voter', [VoterController::class, 'create'])->name('voter.create');
});
