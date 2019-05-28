<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public $successStatus = 200;

    public function getStatusTickets()
    {
        $date = Carbon::today()->subDays(5);
        $success['recent_tickets'] = DB::table('tickets')->where('created_at', '>=', $date)->count();
        $success['pending_tickets'] = DB::table('tickets')->where('status', 0)->count();
        $success['recent_solved_tickets'] = DB::table('tickets')->where('status', 1)->where('created_at', '>=', $date)->count();
        return response()->json(['success' => $success], $this->successStatus);
    }
}
