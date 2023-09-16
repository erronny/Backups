<?php

use Illuminate\Http\Request;

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

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
});


Route::post('forgot', 'ApiController@forgot');
Route::post('login', 'ApiController@login');
Route::get('testsendOtp', 'ApiController@testsendOtp');
Route::post('register', 'ApiController@register');
Route::get('404',['as'=>'404',function(){
	echo "Page no found";
}]);
Route::get('testing',['as'=>'testing',function(){
	echo "testing";
}]);
Route::post('category_list', 'ApiController@category_list');
Route::post('sendOtp', 'ApiController@sendOtp');
Route::post('verifyOtp', 'ApiController@verifyOtp');
Route::post('test_new', 'ApiController@test_new');
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('rename', 'ApiController@rename');    
    Route::post('test', 'ApiController@test');    
    Route::post('documentDelete', 'ApiController@documentDelete');
    Route::post('addBookmark', 'ApiController@addBookmark');
    Route::post('removeBookmark', 'ApiController@removeBookmark');
    Route::post('documentImageDelete', 'ApiController@documentImageDelete');
    
    Route::post('logout', 'ApiController@logout');
    Route::post('profile11', 'ApiController@profile');
    Route::post('refresh', 'ApiController@refresh');
    //Route::post('document', 'ApiController@document');
    Route::post('documentList', 'ApiController@documentList');
    
    Route::post('check_number', 'ApiController@check_number');
    
    Route::post('document_share', 'ApiController@document_share');
    Route::post('document_rename', 'ApiController@document_rename');
    Route::post('document_received', 'ApiController@document_received');
    
    Route::post('share_number', 'ApiController@share_number');
    Route::post('document', 'ApiController@savedocument');
    Route::post('editdocument', 'ApiController@editdocument');
    
    Route::get('document', 'ApiController@document');
    
    Route::get('savecategoty', 'ApiController@savecategoty');
    
    //Route::get('logout', 'ApiController@logout');

    Route::get('tasks', 'TaskController@index');
    Route::get('tasks/{id}', 'TaskController@show');
    Route::post('tasks', 'TaskController@store');
    Route::put('tasks/{id}', 'TaskController@update');
    Route::delete('tasks/{id}', 'TaskController@destroy');
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
