<?php

namespace App\Http\Controllers;


use App\Models\Alert;
use App\Models\SensorData;
use App\Models\Client;
use App\Notifications\DifferenceAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function index()
    {


       
    $clientId = Auth::id(); // Assuming the client is authenticated and their ID is available
    $unreadCount = Alert::where('client_id', $clientId)
                       ->where('is_read', false)
                       ->count();
                       
    $alert = Alert::where('client_id', $clientId)
                  ->orderBy('created_at', 'desc')
                  ->first();

    return view('notification.notification', compact('alert', 'unreadCount'));
}
    

    public function createAlert(SensorData $sensorData)
    {
        $alert = new Alert();
        $alert->client_id = $sensorData->client_id;
        $alert->save();

        $client = Client::find($sensorData->client_id);
        if ($client) {
            Notification::send($client, new DifferenceAlert($sensorData));
        }
    }

    public function markAsRead($id)
{
    $alert = Alert::find($id);
    if ($alert) {
        $alert->is_read = true;
        $alert->save();
        return response()->json(['message' => 'Alert marked as read']);
    }
    return response()->json(['message' => 'Alert not found'], 404);
}

    
}
