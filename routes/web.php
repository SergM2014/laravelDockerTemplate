<?php

use App\Models\User;


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;

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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

//Route::get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
//
//require __DIR__.'/auth.php';

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function() {

    Route::get('/', function(){
       return Inertia::render('Home');
    });

    Route::get('/users', function(){

        return Inertia::render('Users/Index', [
            'users' => User::query()
                ->when(request('search'), function($query, $search){
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user)
                    ]
                ]),

            'filters' => Request::only(['search']),
            'can'=>[
                'createUser' => Auth::user()->can('create', User::class)
            ]


         ]);
    });

    Route::post('/users', function(){
        $attributes = Request::validate([
           'name' => 'required',
           'email' => ['required', 'email'],
           'password' => 'required',
        ]);

        User::create($attributes);

        return redirect('/users');
    });

    Route::get('/users/create', function(){
       return Inertia::render('Users/Create');
    })->can('create','App\Models\User');
        //->middleware('can:create,App\Models\User');

    Route::get('/settings', function(){
        return Inertia::render('Settings');
    });



});
