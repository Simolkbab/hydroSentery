<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;
use Illuminate\Support\Carbon;

class ConsultController extends Controller
{
    

    public function index()
    {
        // Calculate the start and end dates for the last seven days
        $startDate = Carbon::now()->subDays(7)->startOfDay();
    
        $endDate = Carbon::now()->endOfDay();
    
        // Query sensor data for the last seven days
        $sensorDataLastWeek = SensorData::whereBetween('created_at', [$startDate, $endDate])->get();
        $lastThreeSensorData = SensorData::orderBy('id', 'desc')->take(3)->get();
 
        // Calculate average debit for each day
        $averageDebitPerOfEachDay = $sensorDataLastWeek->groupBy(function ($data) {
            return $data->created_at->format('Y-m-d');
        })->map(function ($group) {
            return $group->avg('debit');
        });
    
    
    
        return view('donnees.consult', ['averageDebitPerOfEachDay' => $averageDebitPerOfEachDay,"lastThreeSensorData"=>$lastThreeSensorData]);
    }

    
}
