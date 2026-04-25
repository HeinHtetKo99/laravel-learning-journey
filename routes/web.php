<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StarterController;
use App\Http\Controllers\RoutingController;
use App\Http\Middleware\GT18Middleware;
use App\Http\Middleware\LoacleMiddleware;
use App\Http\Middleware\MyAuthMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\CsrfController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BladeTemplateController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;

Route::view('/', 'welcome');

//Route::get(URI,closurephp )
Route::prefix('admin')->group(function () {
    //login page
    Route::get('/', [AuthController::class, 'getLogin'])->middleware(AuthMiddleware::class);
    Route::post('/login', [AuthController::class, 'Login'])->middleware(AuthMiddleware::class);
    Route::get('/logout', [AuthController::class, 'Logout']);

    Route::middleware([MyAuthMiddleware::class,LoacleMiddleware::class])->group(function(){
        Route::get('/app', [StarterController::class, 'getApp']);

    //starter
        Route::get('/page1', [StarterController::class, 'getPage1']);
        Route::get('/page2', [StarterController::class, 'getPage2']);
        Route::get('/page3', [StarterController::class, 'getPage3']);
        Route::get('/page4', [StarterController::class, 'getPage4']);
        Route::get('/page5', [StarterController::class, 'getPage5']);

        //routing
        Route::get('/routing/view-only', [RoutingController::class, 'viewOnly']);
        Route::get('/routing/passing-data-to-view', [RoutingController::class, 'passingDataToView']);
        Route::get('/routing/route-parameter/{bgColor}/{color}', [RoutingController::class, 'routeParameter']);
        Route::get('/routing/dynamic-route-parameter', [RoutingController::class, 'dynamicRouteParameter']);
        Route::post('/routing/dynamic-route-parameter', [RoutingController::class, 'SubmitdynamicRouteParameter']);
        Route::get('/routing/named-route', [RoutingController::class, 'namedRoute'])->name('routing.named-route');
        Route::get('/routing/middleware', [RoutingController::class, 'middleware']);
        Route::post('/routing/test-middleware', [RoutingController::class, 'testMiddleware'])->middleware(GT18Middleware::class);

        //csrf
        Route::get('/csrf/lecture1', [CsrfController::class, 'lecture1']);
        Route::get('/csrf/lecture2', [CsrfController::class, 'lecture2']);
        Route::get('/csrf/lecture3', [CsrfController::class, 'lecture3']);
        Route::post('/csrf/create', [CsrfController::class, 'create']);
        Route::post('/csrf/get-items', [CsrfController::class, 'getItems']);

        //session
        Route::get('/session/lecture', [SessionController::class, 'lecture']);
        Route::post('/session/put', [SessionController::class, 'put']);
        Route::post('/session/delete/{key}', [SessionController::class, 'delete']);
        Route::post('/session/flush', [SessionController::class, 'flush']);

        //session (tasks management)
        Route::get('/session/tasks', [SessionController::class, 'index'])->name('session.tasks.index');
        Route::post('/session/tasks', [SessionController::class, 'store'])->name('session.tasks.store');
        Route::put('/session/tasks/{taskId}', [SessionController::class, 'update'])->name('session.tasks.update');
        Route::delete('/session/tasks/{taskId}', [SessionController::class, 'destroy'])->name('session.tasks.destroy');

        //blade template
        Route::get('/blade-template/component', [BladeTemplateController::class, 'getComponent'])->name('blade-template.get-component');
        Route::get('/blade-template/localization', [BladeTemplateController::class, 'getLocalization'])->name('blade-template.get-localization');
        Route::post('/blade-template/localization', [BladeTemplateController::class, 'changeLocalization'])->name('blade-template.change-localization');


        //Rest Api Architecture
        //CRUD 
        //create page  Get
        //Create       Post
        //Edit page    Get
        //update       Put
        //delete       Delete
        //show         Get
        //index        Get

        //users
        
        Route::get('/users/reset-password/{user}', [UserController::class, 'resetPassword'])->name('users.reset-password');
        Route::post('/users/reset-password/{user}', [UserController::class, 'resetPasswordSubmit'])->name('users.reset-password-submit');
        Route::resource('users', UserController::class);
        
        //brands
        Route::resource('brands', BrandController::class);

        //categories
        Route::resource('categories', CategoryController::class);

        
        //items
        Route::resource('items', ItemController::class);
        Route::get('/items/{item}/delete', [ItemController::class, 'delete'])->name('items.delete');

        //orders
        Route::resource('orders', OrderController::class);
        Route::get('/orders/{order}/delete', [OrderController::class, 'delete'])->name('orders.delete');
      
    });
});
