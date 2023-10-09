<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\CarbonPeriod;
use Yajra\DataTables\Facades\DataTables;
use Throwable;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
      $config['page_title'] = "DASHBOARD";
      $page_breadcrumbs = [
        ['url' => '#', 'title' => "DASHBOARD"],
      ];
      return view('backend.dashboard.index', compact('config', 'page_breadcrumbs'));
    }

}
