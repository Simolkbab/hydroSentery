<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SensorData;
use Carbon\Carbon;
use DB;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // Get today's date
        $today = Carbon::today();

        // Calculate average debit for today
        $averageDebitToday = SensorData::whereDate('created_at', $today)->avg('debit');

        // Get the date filter from the request
        $selectedDate = $request->input('date');

        // Query to calculate average debit for preceding days filtered by the selected date
        $averageDebitPrecedingDaysQuery = SensorData::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('AVG(debit) as average_debit')
        )
            ->whereDate('created_at', '<', $today);

        // Apply date filter if selectedDate is provided
        if ($selectedDate) {
            $averageDebitPrecedingDaysQuery->whereDate('created_at', '=', $selectedDate);
        }

        $averageDebitPrecedingDaysQuery->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'desc');

        // Paginate the average debit for preceding days
        $perPage = 7;
        $page = $request->get('average_page', 1); // Custom page parameter
        $averageDebitPrecedingDays = $averageDebitPrecedingDaysQuery->paginate($perPage, ['*'], 'average_page', $page);

        return view('historique.history', [
            'averageDebitToday' => $averageDebitToday,
            'averageDebitPrecedingDays' => $averageDebitPrecedingDays,
            'selectedDate' => $selectedDate // Pass selected date to the view
        ]);
    }
}
