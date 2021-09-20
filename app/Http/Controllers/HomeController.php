<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Multipic;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function PortfolioPage(){
        //$image = DB::table('multipics')->get();
        $image = Multipic::all();
        return view('layouts.page.portfolio', compact('image'));
    }
}
