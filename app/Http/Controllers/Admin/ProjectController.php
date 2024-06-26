<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projectsList = Project::all();
        return view('admin.projects.index', compact('projectsList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $technologies = Technology::all();
        $types = Type::all();
        return view('admin.projects.create', compact('types', 'technologies'));
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
            'type_id' => 'required|exists:types,id',
            'technologies' => 'nullable|array',
        ]);

        $project = new Project();
        $project->title = $request->title;
        $project->owner = $request->owner;
        $project->description = $request->description;
        $project->type_id = $request->type_id;
        $project->slug = Str::slug($request->title);
        $project->save();

        // if (isset($request->technologies)) {
        //     $project->technologies()->sync($request->technologies);
        // }

        if($request->has('technologies')){
            $project->technologies()->attach($request->technologies);
        }

        return redirect()->route('admin.projects.index');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));

    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Project $project)
    // {
    //     $request->validate([
    //         'title' => 'required|max:255|unique:projects,title,' . $project->id,
    //         'owner' => 'required|max:255',
    //         'description' => 'nullable|max:255',
    //         'type_id' => 'nullable',
    //     ]);

    //     $slug = Str::slug($request->title, '-');

    //     $project->title = $request->title;
    //     $project->owner = $request->owner;
    //     $project->description = $request->description;
    //     $project->type_id = $request->type_id;
    //     $project->slug = $slug;
    //     $project->save();

    //     return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    // }
    public function update(Request $request, Project $project)
    {
        dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|unique:projects,title,' . $project->id . '|max:255',
            'owner' => 'required|max:255',
            'description' => 'nullable',
            'type_id' => 'required|exists:types,id',
            'technologies' => 'nullable|array', 
            'technologies.*' => 'exists:technologies,id', 
        ]);

       
        $project->title = $validatedData['title'];
        $project->owner = $validatedData['owner'];
        $project->description = $validatedData['description'];
        $project->type_id = $validatedData['type_id'];
        $project->slug = Str::slug($validatedData['title']);
        $project->save();

        
        if (isset($validatedData['technologies'])) {
            $project->technologies()->sync($validatedData['technologies']);
        } else {
            $project->technologies()->detach(); 
        }

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
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
