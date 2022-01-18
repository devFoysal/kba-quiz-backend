<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

// Models
use App\Models\Participant;

class DashboardController extends Controller
{
   public function index()
   {
       $participants = Participant::get();
       return view('backend.pages.dashboard', compact('participants'));
   }
}
