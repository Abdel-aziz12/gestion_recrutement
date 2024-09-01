<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\CandidatureController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoriquesController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PagesController;
use App\Models\Interview;

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

Route::get('index/home', [PagesController::class, 'home'])->name('index/home');
Route::post('index/home', [PagesController::class, 'store']);

Route::get('/', function () {
    return view('home');
});
Auth::routes();

Route::group(['prefixe' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/api/entretiens', [DashboardController::class, 'getEntretiens']);
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');
    Route::get('/notification/show/{id}', [NotificationController::class, 'show'])->name('notification.show');
    Route::post('notification/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notification.markAllAsRead');
    Route::post('/notification/read', [NotificationController::class, 'markAsRead'])->name('notification.read');


    Route::get('/categorie', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categorie/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categorie/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categorie/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categorie/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categorie/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/categorie/search', [CategoryController::class, 'search'])->name('categories.search');
    Route::patch('/categorie/{id}/desactivate', [CategoryController::class, 'desactivate'])->name('categorie.desactivate');
    Route::get('/candidatures', [CandidatureController::class, 'index'])->name('candidatures.index');
    Route::post('/candidatures/store', [CandidatureController::class, 'store'])->name('candidatures.store');
    Route::get('/candidatures/show/{id}', [CandidatureController::class, 'show'])->name('candidatures.show');
    Route::get('/candidatures/{id}/createpage', [CandidatureController::class, 'createpage'])->name('candidatures.createpage');
    Route::get('/candidatures/{id}/pdf', [CandidatureController::class, 'showPdf'])->name('candidatures.showPdf');
    Route::delete('/candidatures/{id}', [CandidatureController::class, 'destroy'])->name('candidatures.destroy');
    Route::get('/candidatures/search', [CandidatureController::class, 'search'])->name('candidatures.search');
    Route::get('/entretiens', [InterviewController::class, 'index'])->name('entretiens.index');
    Route::get('/entretiens/create', [InterviewController::class, 'create'])->name('entretiens.create');
    Route::post('/entretiens/store', [InterviewController::class, 'store'])->name('entretiens.store');
    Route::get('/entretiens/{id}/edit', [InterviewController::class, 'edit'])->name('entretiens.edit');
    Route::put('/entretiens/{id}', [InterviewController::class, 'update'])->name('entretiens.update');
    Route::delete('/entretiens/{id}', [InterviewController::class, 'destroy'])->name('entretiens.destroy');
    Route::get('/entretiens/search', [InterviewController::class, 'search'])->name('entretiens.search');
    Route::patch('/entretiens/{id}/statut', [InterviewController::class, 'updateStatut'])->name('entretiens.updateStatut');


    Route::resource('/configurations', ConfigurationController::class);
    Route::resource('/historiques', HistoriquesController::class);
    // Route pour la déconnexion
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


// Route::get('/nav', function () {
//     return view('partials.pages._nav');
// })->name('partials.pages.nav');


Route::get('/nav', [NavController::class, 'index'])->name('nav');
