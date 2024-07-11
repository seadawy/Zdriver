<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reportController extends Controller
{
    public function allUserCompany()
    {
        $all = User::where('company_id',auth()->user()->company_id)->get();
        return response()->json(['All user of company' => $all]);
    }

    public function scoreDriver()
    {
        $drivers = Driver::with('user')->orderBy('score', 'desc')->get();
        return response()->json($drivers);
    }
    public function scoreCompany()
    {
        $companies = DB::table('companys')
            ->join('users', 'companys.id', '=', 'users.company_id')
            ->join('driver', 'users.id', '=', 'driver.user_id')
            ->select('companys.id', 'companys.name','companys.phone', DB::raw('SUM(driver.score) as total_score'))
            ->groupBy('companys.id', 'companys.name','companys.phone')
            ->orderByDesc('total_score')
            ->get();
        return response()->json(["All companies" => $companies]);
    }
}
