<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPesertaController extends Controller
{
    public function index() {
        return view('layouts.dashboard-peserta');
    }
}
