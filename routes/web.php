<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

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

Route::get('/', [AuthController::class, 'loginView'])->name('login_view');
Route::post('login', [AuthController::class, 'login'])->name('login')->middleware('check-limit-login');
Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordView'])->name('reset_password_view');
Route::post('reset-password', [AuthController::class, 'confirmResetPassword'])->name('reset_password');
Route::get('register', [AuthController::class, 'registerView'])->name('register_view');
Route::group(['middleware' => ['auth-admin']], function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('genealogy', [FamilyMemberController::class, 'genealogy'])->name('genealogy');
    Route::get('add-first', [FamilyMemberController::class, 'addFirstMemberView'])->name('add_first_member_view');
    Route::post('add-first', [FamilyMemberController::class, 'storeFirstMember'])->name('add_first_member');
    Route::get('add-family-member/{from_member_id}', [FamilyMemberController::class, 'addFamilyMemberView'])->name('add_family_member_view');
    Route::post('add-family-member', [FamilyMemberController::class, 'addMemberToFamily'])->name('add_family_member');
    Route::get('edit-family-member/{id}', [FamilyMemberController::class, 'editFamilyMemberView'])->name('edit_family_member_view');
    Route::post('edit-family-member', [FamilyMemberController::class, 'updateFamilyMember'])->name('update_family_member');
    Route::get('member/{id}', [FamilyMemberController::class, 'detailMember'])->name('detail_member');
    Route::post('member/{id}/delete', [FamilyMemberController::class, 'deleteMember'])->name('delete_member');
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::post('users/update-is-enable', [UserController::class, 'updateIsEnable'])->name('update_is_enable');
    Route::get('admin/user/register', [UserController::class, 'adminUserRegisterView'])->name('admin_user_register_view');
    Route::post('admin/user/register', [UserController::class, 'adminUserRegister'])->name('admin_user_register');
    Route::post('logout', [AuthController::class, 'logoutUser'])->name('logout_user');
});

Route::group(['middleware' => ['get-cccd']], function(){
    Route::get('get-cccd/{image_path}', [UserController::class, 'getCCCDImage'])->name('get_cccd');
});
