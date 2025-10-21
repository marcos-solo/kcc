<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display the public projects page.
     */
    public function index()
    {
        // Fetch from database
        $ongoingProjects = Project::where('status', 'ongoing')->latest()->get();
        $pastProjects = Project::where('status', 'past')->latest()->get();

        return view('projects', compact('ongoingProjects', 'pastProjects'));
    }
}
