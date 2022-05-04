<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\ExcelReportController;
use App\Http\Controllers\Kcc\KccController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PdfControlller;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserAuthenticationController::class,'index'])->name('index');
    Route::get('/showRegistrationForm',[UserAuthenticationController::class,'showRegistrationForm'])->name('showRegistrationForm');
    Route::post('/register',[UserAuthenticationController::class,'register'])->name('register');
    Route::post('/login',[UserAuthenticationController::class,'login'])->name('login');
    
});

Route::prefix('users')->name('users.')->group(function(){
     
     
     
     Route::middleware(['auth'])->group(function(){
          
          Route::get('/logout',[UserAuthenticationController::class,'logout'])->name('logout');
          Route::get('/userDashboard',[MenuController::class,'show'])->name('userDashboard');
          
          //for dynamic dropdowns used in ajax request from js/dropdown.js
          Route::post('/getSubdivision',[DropdownController::class,'getSubdivision'])->name('subdivision');
          Route::post('/getMunicipality',[DropdownController::class,'getMunicipality'])->name('municipality');

            //EntryForm
            Route::get('/KCC_entry_update',[MenuController::class,'KCC_entry_update'])->name('KCC_entry_update');
            Route::get('/KM_entry_update',[MenuController::class,'KM_entry_update'])->name('KM_entry_update');
            Route::get('/MGNREGS_Entry_update',[MenuController::class,'MGNREGS_Entry_update'])->name('MGNREGS_Entry_update');
            Route::get('/Anandadhara_Entry_Update',[MenuController::class,'Anandadhara_Entry_Update'])->name('Anandadhara_Entry_Update');
           

            //check data
            Route::post('/checkkccData',[KccController::class,'checkKccData'])->name('checkKccData');

            //insert data into tables
            Route::post('/kccinsert',[KccController::class,'insertToKccTable'])->name('insertKcc');
            Route::post('/insertKishanMandi',[MenuController::class,'insertKishanMandi'])->name('insertKishanMandi');
            Route::post('/insertAnandhara',[MenuController::class,'insertAnandhara'])->name('insertAnandhara');
            Route::post('/insertMgnregs',[MenuController::class,'insertMgnregs'])->name('insertMgnregs');


            //reports
            Route::get('/KCC_Report',[MenuController::class,'KCC_Report'])->name('KCC_Report');
            Route::get('/KM_report',[MenuController::class,'KM_report'])->name('KM_report');
            Route::get('/MGNREGS_report',[MenuController::class,'MGNREGS_report'])->name('MGNREGS_report');
            Route::get('/Anandadhara_report',[MenuController::class,'Anandadhara_report'])->name('Anandadhara_report');

            //pdf
            Route::post('/kccDownload',[PdfControlller::class,'kccDownload'])->name('kccDownload');
            Route::post('/kmDownload',[PdfControlller::class,'kmDownload'])->name('kmDownload');
            Route::post('/anandadharaDownload',[PdfControlller::class,'anandadharaDownload'])->name('anandadharaDownload');
            Route::post('/mgnregsDownload',[PdfControlller::class,'mgnregsDownload'])->name('mgnregsDownload');

            //excel
            Route::post('/cmReportDownload',[ExcelReportController::class,'downloadCMSReport'])->name('downloadCMReport');
            Route::get('/KCCExcelReport',[ExcelReportController::class,'KCCExcelReport'])->name('KCCExcelReport');
            Route::get('/KMExcelReport',[ExcelReportController::class,'KMExcelReport'])->name('KMExcelReport');
            Route::get('/MGNREGSReport',[ExcelReportController::class,'MGNREGSReport'])->name('MGNREGSExcelReport');
            Route::get('/AnandharaReport',[ExcelReportController::class,'AnandharaReport'])->name('AnandharaExcelReport');
            
              
            Route::get('/showExcelReportCritera',[PdfControlller::class,'showExcelReportCritera'])->name('showExcelReportCritera');
            Route::get('/showExceldata',[PdfControlller::class,'showExceldata'])->name('showExceldata');
   });

});

Route::prefix('admin')->name('admin.')->group(function(){
    
     Route::middleware(['auth','isAdmin'])->group(function(){

         
          Route::post('/logout',[UserAuthenticationController::class,'logout'])->name('logout');
          
          Route::resource('usermanagement', AdminDashboardController::class);
          Route::post('/updateRole/{user}',[AdminDashboardController::class,'updateRole'])->name('updateRole');
             

     });
 

});

