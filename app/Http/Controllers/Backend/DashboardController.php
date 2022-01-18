<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

// Models
use App\Models\Participant;
use App\Leaderboard;

// Helper
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
   public function index()
   {
       $participants = Participant::get();
       $leaderboard =  $this->getLeaderboard();
       return view('backend.pages.dashboard', compact('participants', 'leaderboard'));
   }


   public function getLeaderboard(){
        $Leaderboard = Leaderboard::select(DB::raw('count(*) as total'),DB::raw("CONCAT_WS('-',MONTH(created_at),YEAR(created_at)) as monthyear"), DB::raw("MONTH(created_at) as month"), DB::raw("YEAR(created_at) as year"))->groupBy('monthyear')->get();

        return $Leaderboard->groupBy(function ($data){
            return $data->month;
        });
   }
}
