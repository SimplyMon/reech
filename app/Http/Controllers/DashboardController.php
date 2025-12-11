<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Campaign;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $totalCampaigns = $user->campaigns()->count();
        $activeCampaigns = $user->campaigns()->where('status', 'active')->count();

        $totalClients = $user->clients()->count();

        $pipeline = Client::where('user_id', $user->id)
            ->select('client_status', DB::raw('count(*) as count'))
            ->groupBy('client_status')
            ->get();

        $pipelineMap = $pipeline->pluck('count', 'client_status')->toArray();

        $totalLeads = $pipelineMap['Lead'] ?? 0;
        $activeBuyersOrSellers = ($pipelineMap['Buyer'] ?? 0) + ($pipelineMap['Seller'] ?? 0) + ($pipelineMap['Client'] ?? 0);


        return view('Dashboard.index', compact(
            'user',
            'totalClients',
            'totalLeads',
            'activeBuyersOrSellers',
            'totalCampaigns',
            'activeCampaigns',
            'pipelineMap'
        ));
    }
}
