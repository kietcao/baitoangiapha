<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Constants\CurrentPage;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'current_page' => CurrentPage::DASHBOARD,
        ]);
    }
}
