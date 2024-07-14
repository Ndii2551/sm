<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\AthletController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\SelectionRegistController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TestTypeController;
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

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::group(['prefix' => 'announcements'], function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('announcements');
        Route::post('/store', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::delete('/destroy', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');
    });
});
Route::middleware('auth', 'role:1')->group(function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::put('/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    });
    Route::group(['prefix' => 'branches'], function () {
        Route::get('/', [BranchController::class, 'index'])->name('branches');
        Route::put('/update', [BranchController::class, 'update'])->name('branches.update');
    });
    Route::group(['prefix' => 'coaches'], function () {
        Route::get('/', [CoachController::class, 'index'])->name('coaches');
        Route::put('/status', [CoachController::class, 'status'])->name('coaches.status');
    });
    Route::group(['prefix' => 'athletes'], function () {
        Route::get('/', [AthletController::class, 'index'])->name('athletes');
        Route::put('/status', [AthletController::class, 'status'])->name('athletes.status');
    });
    Route::group(['prefix' => 'athletesunvalidate'], function () {
        Route::get('/', [AthletController::class, 'athletesunvalidate'])->name('athletesunvalidate');
        Route::put('/valid', [AthletController::class, 'valid'])->name('athletesunvalidate.valid');
        Route::delete('/invalid', [AthletController::class, 'invalid'])->name('athletesunvalidate.invalid');
    });
    Route::group(['prefix' => 'selections'], function () {
        Route::get('/', [SelectionRegistController::class, 'index'])->name('selections');
        Route::post('/store', [SelectionRegistController::class, 'store'])->name('selections.store');
        Route::put('/update', [SelectionRegistController::class, 'update'])->name('selections.update');
        Route::delete('/destroy', [SelectionRegistController::class, 'destroy'])->name('selections.destroy');
        Route::group(['prefix' => 'details'], function () {
            Route::get('/', [SelectionRegistController::class, 'details'])->name('selections.details');
            Route::get('/submissionsRprt', [SelectionRegistController::class, 'report1'])->name('selections.report1');
            Route::get('/testRprt', [SelectionRegistController::class, 'report2'])->name('selections.report2');
            Route::get('/testRprt', [SelectionRegistController::class, 'report2'])->name('selections.report2');
            Route::put('/close', [SelectionRegistController::class, 'close'])->name('selections.details.close');
            Route::delete('/del', [SelectionRegistController::class, 'del'])->name('selections.details.del');
            Route::post('/setuptest', [TestController::class, 'store'])->name('selections.details.setuptest');
            Route::put('/edittest', [TestController::class, 'update'])->name('selections.details.edittest');
        });
    });
    Route::group(['prefix' => 'testtypes'], function () {
        Route::get('/', [TestTypeController::class, 'index'])->name('testtypes');
        Route::post('/store', [TestTypeController::class, 'store'])->name('testtypes.store');
        Route::delete('/destroy', [TestTypeController::class, 'destroy'])->name('testtypes.destroy');
    });
});
Route::middleware('auth', 'role:2')->group(function () {
    Route::group(['prefix' => 'branchdata'], function () {
        Route::get('/', [BranchController::class, 'branchdata'])->name('branchdata');
        Route::post('/store', [BranchController::class, 'store'])->name('branchdata.store');
        Route::put('/update', [BranchController::class, 'update'])->name('branchdata.update');
    });
    Route::group(['prefix' => 'branchathletes'], function () {
        Route::get('/', [AthletController::class, 'index'])->name('branchathletes');
        Route::put('/status', [AthletController::class, 'status'])->name('branchathletes.status');
    });
    Route::group(['prefix' => 'unvalidate'], function () {
        Route::get('/', [AthletController::class, 'unvalidate'])->name('unvalidate');
        Route::put('/valid', [AthletController::class, 'valid'])->name('unvalidate.valid');
        Route::delete('/invalid', [AthletController::class, 'invalid'])->name('unvalidate.invalid');
    });
    Route::group(['prefix' => 'submissions'], function () {
        Route::get('/', [SelectionRegistController::class, 'submissions'])->name('submissions');
        Route::group(['prefix' => 'details'], function () {
            Route::get('/', [SelectionRegistController::class, 'submissionsdetails'])->name('submissions.details');
            Route::post('/add', [SelectionRegistController::class, 'add'])->name('submissions.details.add');
            Route::delete('/del', [SelectionRegistController::class, 'del'])->name('submissions.details.del');
        });
    });
});
Route::middleware('auth', 'role:3')->group(function () {
    Route::group(['prefix' => 'coachdata'], function () {
        Route::get('/', [CoachController::class, 'coachdata'])->name('coachdata');
        Route::post('/store', [CoachController::class, 'store'])->name('coachdata.store');
        Route::put('/update', [CoachController::class, 'update'])->name('coachdata.update');
    });
    Route::group(['prefix' => 'scores'], function () {
        Route::get('/', [ScoreController::class, 'index'])->name('scores');
        Route::group(['prefix' => 'details'], function () {
            Route::get('/', [ScoreController::class, 'details'])->name('scores.details');
            Route::post('/store', [ScoreController::class, 'store'])->name('scores.details.store');
            Route::put('/update', [ScoreController::class, 'update'])->name('scores.details.update');
        });
    });
    Route::group(['prefix' => 'stats'], function () {
        Route::get('/', [ScoreController::class, 'stats'])->name('stats');
        Route::group(['prefix' => 'details'], function () {
            Route::get('/', [ScoreController::class, 'statdetails'])->name('stats.details');
        });
    });
});
Route::middleware('auth', 'role:4')->group(function () {
    Route::group(['prefix' => 'athletdata'], function () {
        Route::get('/', [AthletController::class, 'athletdata'])->name('athletdata');
        Route::post('/store', [AthletController::class, 'store'])->name('athletdata.store');
        Route::put('/update', [AthletController::class, 'update'])->name('athletdata.update');
    });
    Route::group(['prefix' => 'mystats'], function () {
        Route::get('/', [ScoreController::class, 'mystats'])->name('mystats');
    });
});
Route::middleware('auth', 'verified')->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [AthletController::class, 'dashboard'])->name('dashboard');
    });
});
Route::middleware('auth', 'role:5')->group(function () {
    Route::group(['prefix' => 'dashboard'], function () {
        Route::post('/store', [AthletController::class, 'store'])->name('dashboard.store');
        Route::put('/update', [AthletController::class, 'update'])->name('dashboard.update');
    });
});

require __DIR__ . '/auth.php';
