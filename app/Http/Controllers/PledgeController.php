<?php

namespace App\Http\Controllers;

use App\Models\Pledge;
use Illuminate\Http\Request;

class PledgeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pledge_type' => 'required|string',
            'email' => 'nullable|email',
            'quantity' => 'nullable|integer|min:1',
        ]);

        Pledge::create($request->all());

        return back()->with('success', 'Thank you for your pledge!');
    }

    public function index()
    {
        $pledges = Pledge::latest()->paginate(10);
        return view('pledges.index', compact('pledges'));
    }

   


    public function campaigns()
    {
        // Number of people who pledged for trees
        $treePledgesCount = Pledge::where('pledge_type', 'tree_challenge')->count();

        // Total number of trees pledged (sum of 'quantity')
        $totalTreesPledged = Pledge::where('pledge_type', 'tree_challenge')->sum('quantity');

        // Number of people who pledged for plastic campaign
        $plasticPledgesCount = Pledge::where('pledge_type', 'stop_plastic')->count();

        return view('campaigns', compact('treePledgesCount', 'totalTreesPledged', 'plasticPledgesCount'));
    }

}
