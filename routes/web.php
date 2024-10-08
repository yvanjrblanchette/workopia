<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;


/*  ----- PAGE ROUTES ----- */
/* --- HOME PAGE     --- */
// @desc: Show the home page
// @route: GET '/'
Route::get('/', [PageController::class, 'home'])->name('home');

/* --- DASHBOARD PAGE     --- */
// @desc: Show the dashboard page
// @route: GET '/dashboard'
Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard')->middleware('auth');



/*  ----- RESOURCE ROUTES ----- */
/* --- JOBS RESOURCE --- */
// @desc: Manage the Jobs resource
// Route::resource('jobs', JobController::class);
Route::resource('jobs', JobController::class)->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
Route::resource('jobs', JobController::class)->except(['create', 'store', 'edit', 'update', 'destroy']);




/* --- APPLICATION SUBMISSION --- */
Route::post('/jobs/{job}/apply', [ApplicantController::class, 'store'])->name('applicant.store')->middleware('auth');
Route::delete('/applicants/{applicant}', [ApplicantController::class, 'destroy'])->name('applicant.destroy')->middleware('auth');






Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

/* --- BOOKMARKS RESOURCE --- */
// @desc: Show the bookmarks page
// @route: GET '/bookmarks'
Route::middleware('auth')->group(function () {
  Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
  Route::post('/bookmarks/{job}', [BookmarkController::class, 'store'])->name('bookmarks.store');
  Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});


/* ----- AUTHENTICATION ROUTES ----- */
Route::middleware('guest')->group(function () {
  // @desc: View the Login page
  Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
  // @desc: Authenticate the user
  Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');

  // @desc: View the Register page
  Route::get('/register', [AuthController::class, 'register'])->name('register');
  // @desc: Store user data in the database
  Route::post('/register', [AuthController::class, 'store'])->name('store');
});

// @desc: Log out the user
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');







// --- EXAMPLES OF ROUTES --- //

// @Description: Example of a route using the response helper to read a cookie
// @Route example: GET /read-cookie
// Route::get('/read-cookie', function (Request $request) {
//     $cookieValue = $request->cookie('userId');
//     return response()->json(['cookie' => $cookieValue]);
// });

// @Description: Example of a route using the response helper to set    a cookie
// @Route example: GET /cookie
// Route::get('/cookie', function () {
//     return response()->json(['userId' => '1234567890'])->cookie('userId', '1234567890');
// });

// @Description: Example of a route using the response helper to cookie a file
// @Route example: GET /download
// Route::get('/download', function () {
//     return response()->download(public_path('logo.png'));
// });

// @Description: Example of a route using the response helper ton pass status codes
// @Route example: GET /notfound
// Route::get('/notfound', function () {
//     return response('Page Not Found', 404);
// });

// @Description: Example of a route to get value of query params && form fields
// @Route example: GET /users?name=John&age=32&sort=desc
// Route::get('/users', function (HttpRequest $request) {
//     return $request->input('name');
// });

// @Description: Example of a route to verify if a query param exist (response = 1 for true / 0 for false)
// @Route example: GET /users?name=John&age=32&sort=desc
// Route::get('/users', function (HttpRequest $request) {
//     return $request->has('name');
// });

// @Description: Example of a route with multiple query params
// @Route example: GET /users?name=John&age=32&sort=desc
// Route::get('/users', function (HttpRequest $request) {
//     return $request->all();
// });

// @Description: Example of a route with multiple query params
// @Route example: GET /users?name=John&age=32
// Route::get('/users', function (HttpRequest $request) {
//     return $request->only(['name', 'age']);
// });

// @Description: Example of a route with a query param
// @Route example: GET /users?name=John
// Route::get('/users', function (HttpRequest $request) {
//     return $request->query('name');
// });

// @Description: Route example with multiple params and a constraint
// @Route example: GET /posts/123456/comments/555555
// Route::get('/posts/{id}/comments/{commentId}', function (string $id, string $commentId) {
//     return "Post {$id} - Comment {$commentId}";
// })->('id', '[0-9]+');

// @Description: Route example with a param
// @Route example: GET /posts/123456/
// Route::get('/posts/{id}', function (string $id) {
//     return "Post {$id}";
// });

// @Description: Api route example that returns json
// @Route example: GET /api/v1/users
// Route::get('/api/v1/users', function () {
//     return [
//         'name' => 'John Smith',
//         'email' => 'JSmith@mail.com'
//     ];
// });