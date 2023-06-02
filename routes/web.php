<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [AuthController::class, 'login']);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('genealogy', [FamilyMemberController::class, 'genealogy'])->name('genealogy');
Route::get('add-first', [FamilyMemberController::class, 'addFirstMemberView'])->name('add_first_member_view');
Route::post('add-first', [FamilyMemberController::class, 'storeFirstMember'])->name('add_first_member');
Route::get('add-family-member/{from_member_id}', [FamilyMemberController::class, 'addFamilyMemberView'])->name('add_family_member_view');
Route::post('add-family-member', [FamilyMemberController::class, 'addMemberToFamily'])->name('add_family_member');
Route::get('edit-family-member/{id}', [FamilyMemberController::class, 'editFamilyMemberView'])->name('edit_family_member_view');
Route::post('edit-family-member', [FamilyMemberController::class, 'updateFamilyMember'])->name('update_family_member');
Route::get('member/{id}', [FamilyMemberController::class, 'detailMember'])->name('detail_member');