<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\multipicController;  
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\ChangePass;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Multipic;

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
#For Email varification.
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/home', function () {
    echo "<h1>This is home page</h1>";
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/contacted-with-url-path-in-laravel', [ContactController::class, 'index'])->name('conn');

//Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category'); 

//Category->edit
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);

//Category->update
Route::post('/category/update/{id}', [CategoryController::class, 'update']);

//Category->Softdelete
Route::get('/softdelete/category/{id}', [CategoryController::class, 'softdelete']); 

//Category->Restore data
Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);

//Category->Parmanent delete category data
Route::get('/pdelete/category/{id}', [CategoryController::class, 'pdelete']);

//Query Builder Read Users Data
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     $users = DB::table('users')->get();
//     return view('dashboard', compact('users'));
// })->name('dashboard');

//Eloquent ORM Read Users Data
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     $users = User::all();
//     return view('dashboard', compact('users'));
// })->name('dashboard');



#Create Brand page route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
#Add-Brand route in Brand data.
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand'); 
#Edit Brand Data
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
//Brand->update
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);
//Brand->Parmanent delete brand data
Route::get('/brand/delete/{id}', [BrandController::class, 'deleteBrand']);


#Multipic Page Route
Route::get('/multi/image', [multipicController::class, 'multipic'])->name('multi.image');
#Add-Image route in Multipic data
Route::post('/multi/imageadd', [multipicController::class, 'StoreImage'])->name('store.image');


###############################################################################################
################################### Company Part Backend ######################################
###############################################################################################

#Dasshboard.index Page
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    #$users = User::all();
    #$users = DB::table('users')->get();  
    return view('admin.index');
})->name('dashboard');

#Admin_Logout
Route::get('/user/logout', [AdminController::class, 'Logout'])->name('user.logout');
#Slider_option
Route::get('/home/slider', [AdminController::class, 'HomeSlider'])->name('home.slider');
#Add_Slider 
Route::get('/add/slider', [AdminController::class, 'AddSlider'])->name('add.slider');
#New_slider_post 
Route::post('/store/slider', [AdminController::class, 'StoreSlider'])->name('store.slider');
//New_slider_post Delete
Route::get('/slider/delete/{id}', [AdminController::class, 'deleteSlider']);
#New_slider_post Edit
Route::get('/slider/edit/{id}', [AdminController::class, 'EditSlider']);
//Brand->update
Route::post('/slider/update/{id}', [AdminController::class, 'updateSlider']);


#Home_About
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
#Add_About
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
#POST_Home_About
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
#HomeAbout Edit
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
//HomeAbout->update
Route::post('/about/update/{id}', [AboutController::class, 'updateAbout']);
//HomeAbout->Delete
Route::get('/about/delete/{id}', [AboutController::class, 'deleteAbout']);


#Home_Service 
Route::get('/home/service', [ServicesController::class, 'HomeService'])->name('home.service');
#Add_service
Route::get('/add/service', [ServicesController::class, 'addService'])->name('add.service');
#POST_Home_Service
Route::post('/store/service', [ServicesController::class, 'StoreService'])->name('store.service');
#Home_Service_Edit
Route::get('/service/edit/{id}', [ServicesController::class, 'EditService']);
#Home_Service_Update
Route::post('/service/update/{id}', [ServicesController::class, 'updateService']);
#Home_Service_Delete
Route::get('/service/delete/{id}', [ServicesController::class, 'deleteService']);
#Admin_Contact_Page
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');

#Admin_Add_Contact_Page
Route::get('/add/contact', [ContactController::class, 'AddContact'])->name('add.contact');

#Post_new_contact
Route::post('/store/contact', [ContactController::class, 'StoreContact'])->name('store.contact');

#Contact_Edit
Route::get('/contact/edit/{id}', [ContactController::class, 'EditContact']);

#Contact_Edit
Route::post('/contact/update/{id}', [ContactController::class, 'UpdateContact']);

#Contact_Delete
Route::get('/contact/delete/{id}', [ContactController::class, 'DeleteContact']);

#Admin_Message
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');

#Contact_Message_Delete
Route::get('/message/delete/{id}', [ContactController::class, 'DeleteMessage']);

###############################################################################################
################################### Company Part Forntend #####################################
###############################################################################################

#Home_Page
Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $service = DB::table('home_services')->get();
    $images = Multipic::all();
    return view('home', compact('brands', 'abouts', 'service', 'images'));
});

#Portfolio_Page
Route::get('/portfolio', [HomeController::class, 'PortfolioPage'])->name('portfolio');

#Contact_Page
Route::get('/contact', [ContactController::class, 'ContactPage'])->name('contact');

#Contact_Form
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form'); 




#Change Password and Admin profile for user
Route::get('/change/password', [ChangePass::class, 'ChangePassword'])->name('change.password');

#Update_Password in admin user Profile
Route::post('/password/update', [ChangePass::class, 'PasswordUpdate'])->name('password.update');

#Edit_admin User_Profile
Route::get('/profile/update', [ChangePass::class, 'ProfileUpdate'])->name('profile.update');

#Update_admin User_Profile
Route::post('/update/user/profile', [ChangePass::class, 'UserProfileUpdated'])->name('update.user.profile');