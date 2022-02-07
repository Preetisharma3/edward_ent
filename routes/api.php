<?php

use App\Http\Controllers\Api\v1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'

], function ($router) {
  Route::post('/postTemplate', [AuthController::class, 'postTemplate']);
  Route::get('/editTech/{id}', [AuthController::class, 'editTech']);
  Route::delete('/deleteTech/{id}', [AuthController::class, 'deleteTech']);
  Route::post('/addTechnician', [AuthController::class, 'addTechnician']);
  Route::put('/updateTech', [AuthController::class, 'updateTech']);
  Route::post('/login', [AuthController::class, 'login']);
  Route::get('/getTech', [AuthController::class, 'getTech']);
  Route::post('/postUser', [AuthController::class, 'postUser']);
  Route::get('/searchUser', [AuthController::class, 'searchUser']);
  Route::put('/updateUser', [AuthController::class, 'updateUser']);
  Route::delete('/deleteUser/{id}', [AuthController::class, 'deleteUser']);
  Route::get('/editUser/{id}', [AuthController::class, 'editUser']);
  Route::get('/show', [AuthController::class, 'getData']);
  Route::get('/getUser', [AuthController::class, 'getUser']);
  Route::get('/Agreement', [AuthController::class, 'getAgreement']);
  Route::get('/edit/{id}', [AuthController::class, 'edit']);
  Route::post('/register', [AuthController::class, 'register']);
  Route::post('/logout', [AuthController::class, 'logout']);
  Route::get('/user-profile', [AuthController::class, 'userProfile']);
  Route::post('/postData', [AuthController::class, 'postData']);
  Route::get('/getTemplate', [AuthController::class, 'getTemplate']);
  Route::get('/getQuestion', [AuthController::class, 'getQuestions']);
  Route::get('/editTemplate/{id}', [AuthController::class, 'editTemplate']);
  Route::put('/updateTemplate/{id}', [AuthController::class, 'updateTemplate']);
  Route::post('/assignTemplate', [AuthController::class, 'assignTemplate']);
  Route::get('/getAssign', [AuthController::class, 'getAssign']);
  Route::get('/editAssign/{id}', [AuthController::class, 'editAssign']);
  Route::put('/updateAssign/{id}', [AuthController::class, 'updateAssign']);
  Route::delete('/deleteAssign/{id}', [AuthController::class, 'deleteAssign']);
  Route::post('/postCategory', [AuthController::class, 'postCategory']);
  Route::get('/getCategory', [AuthController::class, 'getCategory']);
  Route::delete('/deleteCategory/{id}', [AuthController::class, 'deleteCategory']);
  Route::post('/postSubcategory', [AuthController::class, 'postSubcategory']);
  Route::get('/getSubCategory', [AuthController::class, 'getSubCategory']);
  Route::get('/editSubcategory/{id}', [AuthController::class, 'editSubcategory']);
  Route::put('/updateSubcategory/{id}', [AuthController::class, 'updateSubcategory']);
  Route::delete('/deleteSubcategory/{id}', [AuthController::class, 'deleteSubcategory']);
  Route::post('/addAgreement', [AuthController::class, 'addAgreement']);
  Route::get('/editAgreement/{id}', [AuthController::class, 'editAgreement']);
  Route::put('/updateAgreement/{id}', [AuthController::class, 'updateAgreement']);
  Route::delete('/deleteAgreement/{id}', [AuthController::class, 'deleteAgreement']);
  Route::post('/addSupplier', [AuthController::class, 'addSupplier']);
  Route::get('/getSupplier', [AuthController::class, 'getSupplier']);
  Route::get('/editSupplier/{id}', [AuthController::class, 'editSupplier']);
  Route::put('/updateSupplier/{id}', [AuthController::class, 'updateSupplier']);
  Route::delete('/deleteSupplier/{id}', [AuthController::class, 'deleteSupplier']);
  Route::get('/editCategory/{id}', [AuthController::class, 'editCategory']);
   Route::put('/updateCategory/{id}', [AuthController::class, 'updateCategory']);
    Route::get('/practice', [AuthController::class, 'index']);




});