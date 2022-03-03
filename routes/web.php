<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\IndexController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\HomeController;
use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\SkillController;
use App\Http\Controllers\backend\ServiceController;
use App\Http\Controllers\backend\PortfolioController;


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
// Route::get('/','IndexController@index');
Route::get('/',[IndexController::class,'index']);
Route::get('/portfolio-details',[IndexController::class,'portfolioDetails']);


//backend-route
Route::get('/login',[LoginController::class,'index']);
Route::get('/register',[LoginController::class,'register'])->name('register');
Route::post('dashboard', [LoginController::class, 'auth_login'])
                                           ->name('login_auth');

//dashboard
  Route::get('/dashboard',[LoginController::class,'dashboard']);

//   Route::get('/logout',[LoginController::class,'logout']);

//home
  Route::get('/home',[HomeController::class, 'index'])
                               ->name('backend.home');

  Route::get('edit/{id}',[HomeController::class,'editData'])
                                     ->name('backend.edit');

  Route::post('/home',[HomeController::class,'storeData'])->name('home');
                                                                                  

  Route::post('/update/{id}',[HomeController::class,'updateData'])
                                         ->name('backend.update');
// about us

Route::get('aboutus',[AboutController::class,'index'])
                             ->name('backend.aboutus');
                             
Route::post('aboutus',[AboutController::class,'storeData'])
                                          ->name('aboutus');

//skill
Route::get('skills',[SkillController::class,'index'])
                                          ->name('backend.skills');   

Route::get('/add-skill',[SkillController::class,'show'])
                                          ->name('backend.skill-add');

Route::post('/add-skill.store',[SkillController::class,'skillStore'])
                                          ->name('backend.skill-add.store'); 

//service
Route::get('/service',[ServiceController::class,'index'])->name('service');
Route::get('/service-add',[ServiceController::class,'show'])->name('service-add');
Route::post('/service-add/store',[ServiceController::class,'store'])->name('service-add.store');

//work and portfolio
Route::get('/portfolio',[PortfolioController::class,'index'])->name('portfolio');
Route::get('/portfolio-add',[PortfolioController::class,'show'])->name('portfolio-add');