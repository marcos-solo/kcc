<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;

class AdminController extends Controller
{
    public function dashboard()
    {
        $members = Member::orderBy('id', 'desc')->paginate(15); // newest first
        return view('admin.dashboard', compact('members'));
    }
    public function analytics()
    {
        // All members
        $members = Member::paginate(10);

        // Members grouped by county
        $membersByCounty = Member::selectRaw('county, COUNT(*) as total')
            ->groupBy('county')
            ->get()
            ->sortByDesc('total');

        // Highest and lowest county
        $highestCounty = $membersByCounty->first();
        $lowestCounty = $membersByCounty->last();

        // Members grouped by organization
        $membersByOrg = Member::selectRaw('organization, COUNT(*) as total')
            ->groupBy('organization')
            ->get()
            ->sortByDesc('total');

        $highestOrg = $membersByOrg->first();
        $lowestOrg = $membersByOrg->last();

        return view('admin.analytics', compact(
            'members',
            'membersByCounty',
            'membersByOrg',
            'highestCounty',
            'lowestCounty',
            'highestOrg',
            'lowestOrg'
        ));
    }

    

}
