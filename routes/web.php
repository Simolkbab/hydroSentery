<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile_siteController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\NotificationsController;
Route::middleware('auth:client')->group(function () {
    // Routes accessible only to authenticated users

    Route::view('/message', 'profile.message')->name('message');
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::get('/consult', [ConsultController::class, 'index'])->name('consult');
   

    // Route pour afficher l'historique
    Route::get('/history', [HistoryController::class, 'index'])->name('history');

    // Route pour afficher les notifications
    Route::get('/notification', [NotificationsController::class, 'index'])->name('notification');
    Route::get('/profile', [Profile_siteController::class, 'show'])->name('show');
    Route::get('/editEmail', [Profile_siteController::class,'editEmail'])->name('editEmail');
    Route::get('/editNom', [Profile_siteController::class,'editNom'])->name('editNom');
    Route::get('/ediTelephone', [Profile_siteController::class,'editTelephone'])->name('ediTelephone');
    Route::get('/editPassword', [Profile_siteController::class,'editPassword'])->name('editPassword');
    Route::patch('/UpdateEmail', [Profile_siteController::class,'updateEmail'])->name('updateEmail');
    Route::patch('/UpdateNom', [Profile_siteController::class,'UpdateNom'])->name('UpdateNom');

    Route::patch('/UpdateTelephone', [Profile_siteController::class,'updateTelephone'])->name('updateTelephone');
    Route::patch('/UpdatePassword', [Profile_siteController::class,'updatePassword'])->name('updatePassword');
    Route::delete('/delete-profile-image', [Profile_siteController::class,'deleteProfileImage'])->name('delete-profile-image');
    Route::patch('/update-profile-image', [Profile_siteController::class,'updateProfileImage'])->name('update-profile-image');
    
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');
});

Route::get("/", function () {
    if (!auth()->check()) {
        return redirect('/login');
    } 
})->middleware('guest');


Route::middleware('guest:client')->group(function () {
    Route::get('/compte', [ProfileController::class, 'create'])->name('create');
    Route::post('/compte', [ProfileController::class, 'store'])->name('store');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});



// Route::post('/store-data', function(Request $request)
// {
//     // Retrieve data from the incoming request
//     $data = $request->all();

//     // Process the data as needed

//     // Store the data in a file



//     $filePath = storage_path('app/data.json'); 
//     file_put_contents($filePath, json_encode($data)); 

//     return response()->json(['message' => 'Data stored successfully']);
// });
