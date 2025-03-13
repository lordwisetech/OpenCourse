<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Http\Controllers\CourseController;


use App\Http\Controllers\AuthController;

Route:: get('/register', function(){
    return view('register');
});

Route::get('/courses/{course}', function ($id) {
    $course = \App\Models\Course::with('user')->findOrFail($id);
    return view('coursesshow', compact('course'));
})->name('coursesshow');


Route::get('/', function () {
    return view('Landing');
});

Route::get('/login', function(){
    return view('login');
});

Route::get('/dashboard', function(){
    return view('dashboard');
});

Route:: get('/create/course', function(){
    return view('createcourse');
});


Route::get('/dashboard/student', function(){
    return view('studentMode');
});

Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');

Route::get('/all-courses', function () {
    $courses = \App\Models\Course::with('user')->get(); // Fetch all courses with creator details
    return view('all', compact('courses'));
})->name('all');


//Route::get('/courses', [CourseController::class, 'index'])->name('courses');




Route::middleware(['auth'])->group(function () {
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
});

Route::get('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login')->with('message', 'Logged out successfully!');
})->name('logout');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');


Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');


Route::get('/courses/{id}', [CourseController::class, 'show'])->name('coursesshow');



 Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('courses.my');
