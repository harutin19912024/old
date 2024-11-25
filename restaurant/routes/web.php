<?php

use Illuminate\Support\Facades\Route;
use App\Admin\Admin;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductTabsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\MediaCenterController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\ContactUsDataController;



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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('site');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/elements', [App\Http\Controllers\HomeController::class, 'elements'])->name('elements');
Route::get('/food_menu', [App\Http\Controllers\HomeController::class, 'foodMenu'])->name('food_menu');
Route::get('/menu', [App\Http\Controllers\HomeController::class, 'menu'])->name('menu');
Route::get('/single_blog', [App\Http\Controllers\HomeController::class, 'singleBlog'])->name('single_blog');
Route::POST('/site/contactus', [App\Http\Controllers\HomeController::class, 'storeContactUsData'])->name('contact-sent');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('/', AdminController::class);

    Route::resource('/contact-us', ContactUsController::class);
    Route::resource('/contact-us-data', ContactUsDataController::class);
    Route::resource('/categories', CategoryController::class);
    //Route::resource('/product-tabs', ProductTabsController::class);
    Route::resource('/about-us', AboutUsController::class);

    Route::GET('/overview', [AboutUsController::class, 'overview']);
    Route::GET('overview/create', [AboutUsController::class, 'createOverview']);
    Route::GET('/overview/{id}/edit', [AboutUsController::class, 'overviewEdit']);
    Route::PUT('/overview/{id}', [AboutUsController::class, 'overviewEditStore']);
    Route::POST('/overview', [AboutUsController::class, 'overviewStore']);
    Route::DELETE('/overview/{id}/delete', [AboutUsController::class,'destroyOverview']);

    Route::GET('/history', [AboutUsController::class, 'history']);
    Route::GET('/history/{id}/edit', [AboutUsController::class, 'historyEdit']);
    Route::PUT('/history/{id}', [AboutUsController::class, 'historyStore']);


    //Route::POST('/about-us/overview', 'AboutUsController@overview');
    Route::GET('/integrated', [AboutUsController::class, 'integrated']);
    Route::GET('/history', [AboutUsController::class, 'history']);
    Route::GET('/people', [AboutUsController::class, 'people']);

    Route::resource('/slider', SliderController::class);
    Route::resource('/why-tahweel', WhyTahweelController::class);
    Route::POST('/why-tahweel/update-ordering', [WhyTahweelController::class, 'updateOrdering']);
    Route::POST('/slider/update-ordering', [SliderController::class, 'updateOrdering']);
    //Route::POST('/product-tabs/update-ordering', [ProductTabsController::class,'updateOrdering']);

    Route::resource('/social', SocialController::class);
    Route::resource('/catalog', CatalogController::class);

    Route::resource('/media-center', MediaCenterController::class);
    Route::DELETE('/media-center/{media_id}/destroy-image/{image_id}', [MediaCenterController::class, 'destroyImage']);
    Route::POST('/media-center/update-ordering', [MediaCenterController::class, 'updateOrdering']);

    //Route::resource('/press-releases', 'PressReleaseController');
    //Route::DELETE('/press-releases/{media_id}/destroy-image/{image_id}', 'NewsletterController@destroyImage');

    Route::prefix('products')->group(function () {
        Route::resource('/', ProductController::class);
        Route::GET('/details', [ProductController::class,'details']);
        Route::DELETE('/{product_id}/destroy-image/{image_id}', [ProductController::class,'destroyImage']);
        Route::GET('/{id}/specification', [ProductController::class,'specification']);
        Route::POST('/{id}/specification', [ProductController::class,'specificationStore']);
        Route::GET('/{id}/edit', [ProductController::class,'edit']);
        Route::POST('/{id}/delete', [ProductController::class,'destroyProduct']);
        Route::PUT('/{id}', [ProductController::class,'update']);

        Route::POST('/ajax-delete', [ProductController::class,'ajaxDelete']);
        Route::POST('/ajax-edit', [ProductController::class,'ajaxEdit']);
        Route::POST('/ajax-get', [ProductController::class,'ajaxGet']);
        Route::GET('/{id}/featured', [ProductController::class,'featured']);
        Route::POST('/{id}/featured-store', [ProductController::class,'featuredStore']);
        Route::POST('/update-ordering', [ProductController::class,'updateOrdering']);
    });

});
