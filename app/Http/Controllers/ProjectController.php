<?php

namespace App\Http\Controllers;

use App\Business\Interfaces\IProjectService;

class ProjectController extends Controller
{

    private IProjectService $projectService;

    public function __construct(IProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        return view('projects.index', ['projects' => $this->projectService->getAll()]);
    }
}
