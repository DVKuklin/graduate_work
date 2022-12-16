<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\Admin\AdminApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(PagesController::class)->group(function() {
    Route::get('sections','getSections');
    Route::post('get_themes_and_section_by_section_url','getThemesAndSectionBySectionUrl');
    Route::post('get_paragraps_by_section_and_theme_url','getParagraphsBySectionAndThemeUrl');
});

Route::controller(UserController::class)->group(function() {
    Route::post('auth','authUser');
});

Route::controller(DeveloperController::class)->group(function() {
    Route::post('change_paragraps_from_old_table','changeParagraphsFromOldTable');
    Route::post('test','test');
    Route::post('set_theme_url','setThemeUrl');
    Route::post('set_allowed_themes','setAllowedThemes');
});

Route::controller(AdminApiController::class)->group(function() {
    Route::post('admin/get_data_for_user_extended','getDataForUserExtended');
    Route::post('admin/get_data_for_paragraphs_edit','getDataForParagraphsEdit');    
    Route::post('admin/set_permition','setPermition');
});


