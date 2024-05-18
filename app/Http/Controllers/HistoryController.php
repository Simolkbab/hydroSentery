<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;
class HistoryController extends Controller
{
    public function index()
    {
        // Retrieve sensor data ordered by the latest data
        $sensorData = SensorData::orderBy('id',"desc")->paginate(10); // Change 10 to the desired number of items per page
        
        return view('historique.history', ['sensorData' => $sensorData]);
    }
    
}
