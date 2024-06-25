<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Type;
use Illuminate\Support\Str;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectsList = Project::all();
        return view('admin.projects.index',compact('projectsList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create',compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:projects|max:255',
            'owner' => 'required|max:255',
            'description' => 'nullable|max:255',
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->owner = $request->owner;
        $project->description = $request->description;
        $project->type_id = $request->type_id;
        $project->slug = Str::slug($request->title);
        $project->save();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|max:255|unique:projects,title,' . $project->id,
            'owner' => 'required|max:255',
            'description' => 'nullable|max:255',
            'type_id' => 'nullable'
        ]);

        $slug = Str::slug($request->title, '-');

        $project->title = $request->title;
        $project->owner = $request->owner;
        $project->description = $request->description;
        $project->type_id = $request->type_id;
        $project->slug = $slug;
        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
