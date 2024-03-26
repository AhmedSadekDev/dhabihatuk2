<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChoppingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\LangController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WrappingController;
use Illuminate\Support\Facades\Route;

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

Route::get('/lang/set/{lang}', [LangController::class, 'set'])->name('lang');
Route::group(['prefix' => '/', 'middleware' => ['Lang']], function () {
    Route::get('/MentanecMode', [AdminController::class, 'MentanecMode'])->name('MentanecMode');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/login', [AuthController::class, 'signIn'])->name('signIn');
    Route::post('/signUp', [AuthController::class, 'signUp'])->name('signUp');
    Route::group(['prefix' => '/', 'middleware' => ['Admin']], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin');
        /**
         * Route For Roles Controller
         */
        Route::group(
            ['prefix' => '/roles'],
            function () {
                Route::get('/', [RoleController::class, 'index'])->name('roles');
                Route::get('/addRole', [RoleController::class, 'addRole'])->name('addRole')->middleware('can:addRole');
                Route::post('/', [RoleController::class, 'store'])->name('role.store');
                Route::delete('/', [RoleController::class, 'delete'])->name('role.delete')->middleware('can:deleteRole');
                Route::PUT('/', [RoleController::class, 'update'])->name('role.update');
                Route::get('/editRoles/{id}', [RoleController::class, 'edit'])->name('role.edit')->middleware('can:editRole');
            }
        );

        /**
         * Route For Employees Controller
         */
        Route::group(
            ['prefix' => '/employee'],
            function () {
                Route::get('/', [EmployeeController::class, 'index'])->name('employee');
                Route::get('/searchEmployee', [EmployeeController::class, 'searchEmployee'])->name('searchEmployee');
                Route::get('/addEmployee', [EmployeeController::class, 'addEmployee'])->name('addEmployee')->middleware('can:addEmployee');
                Route::post('/', [EmployeeController::class, 'store'])->name('employee.store');
                Route::delete('/', [EmployeeController::class, 'delete'])->name('employee.delete')->middleware('can:deleteEmployee');
                Route::PUT('/', [EmployeeController::class, 'update'])->name('employee.update');
                Route::PUT('/verify', [EmployeeController::class, 'verify'])->name('employee.verify');
                Route::get('/editEmployee/{id}', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware('can:editEmployee');
            }
        );
        /**
         * Route For User Controller
         */
        Route::group(
            ['prefix' => '/users'],
            function () {
                Route::get('/', [UserController::class, 'index'])->name('users');
                Route::get('/search/searchUser', [UserController::class, 'searchUser'])->name('searchUser');
                Route::get('/user/addUser', [UserController::class, 'addUser'])->name('addUser')->middleware('can:addUser');
                Route::post('/', [UserController::class, 'store'])->name('users.store');
                Route::post('/importExcel', [UserController::class, 'importExcel'])->name('users.importExcel');
                Route::delete('/', [UserController::class, 'delete'])->name('users.delete')->middleware('can:deleteUser');
                Route::PUT('/', [UserController::class, 'update'])->name('users.update');
                Route::PUT('/verify', [UserController::class, 'verify'])->name('users.verify');
                Route::get('/editUser/{id}', [UserController::class, 'edit'])->name('users.edit')->middleware('can:editUser');
                Route::get('/accepet/{id}', [UserController::class, 'accepet'])->name('users.accepet')->middleware('can:accepetOrRejecet');
                Route::get('/rejecet/{id}', [UserController::class, 'rejecet'])->name('users.rejecet')->middleware('can:accepetOrRejecet');
            }
        );
        /**
         * Route For admins Controller
         */
        Route::group(
            ['prefix' => '/admins'],
            function () {
                Route::get('/', [AdminController::class, 'indexAdmins'])->name('admins');
                Route::get('/addAdmin', [AdminController::class, 'addAdmin'])->name('addAdmin')->middleware('can:addAdmin');
                Route::post('/', [AdminController::class, 'store'])->name('admins.store');
                Route::delete('/', [AdminController::class, 'delete'])->name('admins.delete')->middleware('can:deleteAdmin');
                Route::PUT('/', [AdminController::class, 'update'])->name('admins.update')->middleware('can:editAdmin');
                Route::PUT('/verify', [AdminController::class, 'verify'])->name('admins.verify')->middleware('can:editAdmin');
                Route::get('/editAdmin/{id}', [AdminController::class, 'edit'])->name('admins.edit')->middleware('can:editAdmin');
            }
        );

        /**
         * Route For sliders Controller
         */
        Route::group(
            ['prefix' => '/sliders'],
            function () {
                Route::get('/', [SliderController::class, 'index'])->name('sliders');
                Route::get('/addSlider', [SliderController::class, 'addSlider'])->name('addSlider')->middleware('can:addSlider');
                Route::post('/', [SliderController::class, 'store'])->name('sliders.store');
                Route::delete('/', [SliderController::class, 'delete'])->name('sliders.delete')->middleware('can:deleteSlider');
                Route::PUT('/', [SliderController::class, 'update'])->name('sliders.update');
                Route::PUT('/verify', [SliderController::class, 'verify'])->name('sliders.verify');
                Route::get('/editSlider/{id}', [SliderController::class, 'edit'])->name('sliders.edit')->middleware('can:editSlider');
            }
        );
        /**
         * Route For categories Controller
         */
        Route::group(
            ['prefix' => '/categories'],
            function () {
                Route::get('/', [CategoryController::class, 'index'])->name('categories');
                Route::get('/addCategory', [CategoryController::class, 'addCategory'])->name('addCategory')->middleware('can:addCategory');
                Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
                Route::delete('/', [CategoryController::class, 'delete'])->name('categories.delete')->middleware('can:deleteCategory');
                Route::PUT('/', [CategoryController::class, 'update'])->name('categories.update');
                Route::PUT('/verify', [CategoryController::class, 'verify'])->name('categories.verify');
                Route::get('/editCategory/{id}', [CategoryController::class, 'edit'])->name('categories.edit')->middleware('can:editCategory');
            }
        );
        /**
         * Route For products Controller
         */
        Route::group(
            ['prefix' => '/products'],
            function () {
                Route::get('/', [ProductController::class, 'index'])->name('products');
                Route::get('/addProduct', [ProductController::class, 'addProduct'])->name('addProduct')->middleware('can:addProduct');
                Route::post('/', [ProductController::class, 'store'])->name('products.store');
                Route::delete('/', [ProductController::class, 'delete'])->name('products.delete')->middleware('can:deleteProduct');
                Route::PUT('/', [ProductController::class, 'update'])->name('products.update');
                Route::PUT('/verify', [ProductController::class, 'verify'])->name('products.verify');
                Route::get('/editProduct/{id}', [ProductController::class, 'edit'])->name('products.edit')->middleware('can:editProduct');
            }
        );
        Route::group(['prefix' => 'settings'], function () {
            Route::group(['middleware' => 'can:setting_change'], function () {
                Route::get('/', [SettingController::class, 'index'])->name('setting');
                Route::post('/store', [SettingController::class, 'store'])->name('setting.store');
                Route::post('/deleteChat', [SettingController::class, 'deleteChat'])->name('setting.deleteChat');
                Route::post('/deleteResearch', [SettingController::class, 'deleteResearch'])->name('setting.deleteResearch');
                Route::post('/deleteProjecets', [SettingController::class, 'deleteProjecets'])->name('setting.deleteProjecets');
                Route::post('/deleteQuestions', [SettingController::class, 'deleteQuestions'])->name('setting.deleteQuestions');
                Route::post('/deleteNotification', [SettingController::class, 'deleteNotification'])->name('setting.deleteNotification');
            });
        });
        Route::group(['prefix' => 'socials', 'as' => 'socials.'], function () {
            Route::group(['middleware' => 'can:setting_change'], function () {
                Route::get('/', [SocialController::class, 'index'])->name('index');
            });

            Route::group(['middleware' => 'can:setting_change'], function () {
                Route::get('/create', [SocialController::class, 'create'])->name('create');
                Route::post('/store', [SocialController::class, 'store'])->name('store');
            });

            Route::group(['middleware' => 'can:setting_change'], function () {
                Route::get('/edit/{id}', [SocialController::class, 'edit'])->name('edit');
                Route::put('/update', [SocialController::class, 'update'])->name('update');
                Route::put('/display', [SocialController::class, 'display'])->name('display');
            });

            Route::delete('/destroy', [SocialController::class, 'destroy'])->name('destroy');
        });

        /**
         * Route For Chopping Controller
         */
        Route::group(
            ['prefix' => '/Chopping'],
            function () {
                Route::get('/', [ChoppingController::class, 'index'])->name('Chopping');
                Route::get('/addChopping', [ChoppingController::class, 'addChopping'])->name('addChopping')->middleware('can:addChopping');
                Route::post('/', [ChoppingController::class, 'store'])->name('Chopping.store');
                Route::delete('/', [ChoppingController::class, 'delete'])->name('Chopping.delete')->middleware('can:deleteChopping');
                Route::PUT('/', [ChoppingController::class, 'update'])->name('Chopping.update');
                Route::PUT('/verify', [ChoppingController::class, 'verify'])->name('Chopping.verify');
                Route::get('/editChopping/{id}', [ChoppingController::class, 'edit'])->name('Chopping.edit')->middleware('can:editChopping');
            }
        );
        /**
         * Route For Wrapping Controller
         */
        Route::group(
            ['prefix' => '/Wrapping'],
            function () {
                Route::get('/', [WrappingController::class, 'index'])->name('Wrapping');
                Route::get('/addWrapping', [WrappingController::class, 'addWrapping'])->name('addWrapping')->middleware('can:addWrapping');
                Route::post('/', [WrappingController::class, 'store'])->name('Wrapping.store');
                Route::delete('/', [WrappingController::class, 'delete'])->name('Wrapping.delete')->middleware('can:deleteWrapping');
                Route::PUT('/', [WrappingController::class, 'update'])->name('Wrapping.update');
                Route::PUT('/verify', [WrappingController::class, 'verify'])->name('Wrapping.verify');
                Route::get('/editWrapping/{id}', [WrappingController::class, 'edit'])->name('Wrapping.edit')->middleware('can:editWrapping');
            }
        );
        /**
         * Route For notifications Controller
         */
        Route::group(
            ['prefix' => '/notifications'],
            function () {
                Route::get('/', [NotificationController::class, 'index'])->name('notifications');
                Route::post('/', [NotificationController::class, 'store'])->name('notifications.store');
            }
        );
        /**
         * Route For about Controller
         */
        Route::group(
            ['prefix' => '/about'],
            function () {
                Route::get('/', [AboutController::class, 'index'])->name('about');
                Route::post('/', [AboutController::class, 'update'])->name('about.update');
            }
        );
        /**
         * Route For terms Controller
         */
        Route::group(
            ['prefix' => '/terms'],
            function () {
                Route::get('/', [AboutController::class, 'terms'])->name('terms');
                Route::post('/', [AboutController::class, 'updateterms'])->name('terms.update');
            }
        );
        /**
         * Route For contact Controller
         */
        Route::group(
            ['prefix' => '/contact'],
            function () {
                Route::get('/', [ContactController::class, 'index'])->name('contact');
                Route::delete('/', [ContactController::class, 'delete'])->name('contact.delete');
            }
        );
    });
});
