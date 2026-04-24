<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogMasterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DealershipController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\FrontendController;

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
Route::get('/sitemap.xml', [FrontendController::class, 'sitemap'])->name('sitemap');

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/redirect', function () {
    return view('redirect');
})->name('redirect');

Route::get('/about', function () {
    return view('pages.frontend.about');
})->name('about');

Route::get('/service', function () {
    return view('pages.frontend.service');
})->name('service');

Route::get('/blog', function () {
    return view('pages.frontend.blog');
})->name('blog');

Route::get('/product', function () {
    return view('pages.frontend.product');
})->name('product');

Route::get('/contact', function () {
    return view('pages.frontend.contact');
})->name('contact');

Route::get('/dealership/interested/form', function () {
    return view('pages.frontend.form');
})->name('form');

Route::get('/water-purifier', function () {
    return view('pages.frontend.water-purifier');
})->name('water-purifier');

Route::get('/water-purifiers', function () {
    return view('pages.frontend.water-purifiers');
})->name('water-purifiers');

Route::get('/water-filter-for-home', function () {
    return view('pages.frontend.water-filter-for-home');
})->name('water-filter-for-home');

Route::get('/water-purifier-for-home', function () {
    return view('pages.frontend.water-purifier-for-home');
})->name('water-purifier-for-home');

Route::get('/ro-installation-near-me', function () {
    return view('pages.frontend.ro-installation-near-me');
})->name('ro-installation-near-me');

Route::get('/water-softener', function () {
    return view('pages.frontend.water-softener');
})->name('water-softener');

Route::get('/soft-water-conditioner', function () {
    return view('pages.frontend.soft-water-conditioner');
})->name('soft-water-conditioner');

Route::get('/ro-water-plant', function () {
    return view('pages.frontend.ro-water-plant');
})->name('ro-water-plant');

Route::get('/blog', [FrontendController::class, 'blogindex'])->name('blog');

Route::get('/blog/filter/{id}/{name}', [FrontendController::class, 'blogfilter'])->name('blog-filter');

Route::get('/blog/search', [FrontendController::class, 'searchblog'])->name('blog-search');

Route::get('/{title}/{id}', [FrontendController::class, 'blogreadmore'])->name('read-blog');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Home - Prevent Back Browser Button - After Logout
Route::middleware(['prevent-back-history'])->get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Change Password - Index
    Route::middleware(['auth:sanctum', 'verified'])->get('/zwork-technology/admin/password_change', [ChangeProfileController::class, 'index_password'])->name('settings');

    // Change Password - Store
    Route::middleware(['auth:sanctum', 'verified'])->post('/zwork-technology/admin/password_update', [ChangeProfileController::class, 'update_password'])->name('change.password');

    // Profile - Index
    Route::middleware(['auth:sanctum', 'verified'])->get('/zwork-technology/admin/profile_change', [ChangeProfileController::class, 'index_profile'])->name('profile');

    // PROFILE - STORE
    Route::middleware(['auth:sanctum', 'verified'])->post('/zwork-technology/admin/profile_update', [ChangeProfileController::class, 'update_profile'])->name('change.profile');

    // BLOG MASTER CONTROLLER
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        // INDEX
        Route::middleware(['auth:sanctum', 'verified'])->get('/zwork-technology/admin/blog/master', [BlogMasterController::class, 'index'])->name('blog.master.index');
        // CREATE
        Route::middleware(['auth:sanctum', 'verified'])->get('/zwork-technology/admin/blog/master/create', [BlogMasterController::class, 'create'])->name('blog.master.create');
        // STORE
        Route::middleware(['auth:sanctum', 'verified'])->post('/zwork-technology/admin/blog/master/store', [BlogMasterController::class, 'store'])->name('blog.master.store');
        // EDIT
        Route::middleware(['auth:sanctum', 'verified'])->get('/zwork-technology/admin/blog/master/edit/{id}', [BlogMasterController::class, 'edit'])->name('blog.master.edit');
        // UPDATE
        Route::middleware(['auth:sanctum', 'verified'])->put('/zwork-technology/admin/blog/master/update/{id}', [BlogMasterController::class, 'update'])->name('blog.master.update');
        // DELETE
        Route::middleware(['auth:sanctum', 'verified'])->put('/zwork-technology/admin/blog/master/delete/{id}', [BlogMasterController::class, 'delete'])->name('blog.master.delete');
        // DESTROY
        Route::middleware(['auth:sanctum', 'verified'])->delete('/zwork-technology/admin/blog/master/destroy/{id}', [BlogMasterController::class, 'destroy'])->name('blog.master.destroy');
    });

    // BLOG CONTROLLER
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        // INDEX
        Route::middleware(['auth:sanctum', 'verified'])->get('/zwork-technology/admin/blog', [BlogController::class, 'index'])->name('blog.index');
        // CREATE
        Route::middleware(['auth:sanctum', 'verified'])->get('/zwork-technology/admin/blog/create', [BlogController::class, 'create'])->name('blog.create');
        // STORE
        Route::middleware(['auth:sanctum', 'verified'])->post('/zwork-technology/admin/blog/store', [BlogController::class, 'store'])->name('blog.store');
        // EDIT
        Route::middleware(['auth:sanctum', 'verified'])->get('/zwork-technology/admin/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        // UPDATE
        Route::middleware(['auth:sanctum', 'verified'])->put('/zwork-technology/admin/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
        // ACTIVE
        Route::middleware(['auth:sanctum', 'verified'])->put('/zwork-technology/admin/blog/active/{id}', [BlogController::class, 'active'])->name('blog.active');
        // DE ACTIVE
        Route::middleware(['auth:sanctum', 'verified'])->put('/zwork-technology/admin/blog/deactive/{id}', [BlogController::class, 'deactive'])->name('blog.deactive');
        // PIN
        Route::middleware(['auth:sanctum', 'verified'])->put('/zwork-technology/admin/blog/pin/{id}', [BlogController::class, 'pin'])->name('blog.pin');
        // UN PIN
        Route::middleware(['auth:sanctum', 'verified'])->put('/zwork-technology/admin/blog/unpin/{id}', [BlogController::class, 'unpin'])->name('blog.unpin');
        // DELETE
        Route::middleware(['auth:sanctum', 'verified'])->put('/zwork-technology/admin/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
        // DESTROY
        Route::middleware(['auth:sanctum', 'verified'])->delete('/zwork-technology/admin/blog/destroy/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    });

    // CONTACT CONTROLLER
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        // INDEX
        Route::middleware(['auth:sanctum', 'verified'])->get('/zwork-technology/contact', [ContactController::class, 'index'])->name('contact.index');
        // ACTIVE
        Route::middleware(['auth:sanctum', 'verified'])->put('/zwork-technology/contact/reach_out/{id}', [ContactController::class, 'reachout'])->name('contact.reach_out');
    });
});

// CONTACT CONTROLLER // STORE
Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

// DEALERSHIP CONTROLLER // STORE
Route::post('/dealership/interested/form/store', [DealershipController::class, 'store'])->name('dealership.store');
