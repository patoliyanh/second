<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function(){
  Route::post('/logout',[AuthController::class, 'logout']);

});
Route::apiResource('posts',PostController::class);

// Route::post('/email/verification-notification', function (Request $request) {
//     if ($request->user()->hasVerifiedEmail()) {
//         return response()->json(['message' => 'Already verified'], 400);
//     }

//     $request->user()->sendEmailVerificationNotification();

//     return response()->json(['message' => 'Verification link sent']);
// })->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');


// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill(); // marks the email as verified
//     return response()->json(['message' => 'Email verified successfully!']);
// })->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

// Route::get('/email/verified-status', function (Request $request) {
//     return response()->json([
//         'verified' => $request->user()->hasVerifiedEmail(),
//     ]);
// })->middleware('auth:sanctum');
// Route::middleware(['auth:sanctum', 'verified.api'])->get('/dashboard', function () {
//     return response()->json(['message' => 'Welcome verified user!']);
// });
