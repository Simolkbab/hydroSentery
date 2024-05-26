<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Profile_siteController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\NotificationsController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\SensorData;
use App\Models\Alert;
use App\Models\Client;
use App\Mail\AlertMail;


Route::middleware('auth:client,admin')->group(function () {
    // Routes accessible only to authenticated users

    Route::view('/message', 'profile.message')->name('message');
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::get('/consult', [ConsultController::class, 'index'])->name('consult');
    Route::post('/mark-as-read/{id}', [NotificationsController::class, 'markAsRead'])->name('mark-as-read');
   

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
   
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:admin')->group(function () {

    Route::get('/compte', [ProfileController::class, 'create'])->name('create');
    Route::post('/compte', [ProfileController::class, 'store'])->name('store');
});


// Route::get('/test', function() {
//     // Fetch the first alert for testing purposes
//     $alert = Alert::first();

//     if ($alert) {
//         // Get all clients
//         $clients = Client::all();

//         $successEmails = [];
//         $failedEmails = [];

//         foreach ($clients as $client) {
//             // Send the email to each client
//             try {
//                 Mail::to($client->email)->send(new AlertMail(
//                     $alert->message,
//                     $alert->created_at->format('d/m/Y'),
//                     $alert->created_at->format('H:i')
//                 ));
//                 $successEmails[] = $client->email;
//             } catch (\Exception $e) {
//                 $failedEmails[] = $client->email . ' (Error: ' . $e->getMessage() . ')';
//             }
//         }

//         return response()->json([
//             'message' => 'Emails sent',
//             'success' => $successEmails,
//             'failed' => $failedEmails,
//         ]);
//     } else {
//         return response()->json([
//             'message' => 'No alert found.'
//         ], 404);
//     }
// });
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
