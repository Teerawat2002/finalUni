<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projects;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::orderBy('id', 'asc')->get();
        $total = Projects::count();
        return view('admin.projects.home', compact('projects', 'total'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    // public function save(Request $request)
    // {
    //     // Validate the request data
    //     $validated = $request->validate([
    //         'project_title' => 'required|string|max:255',
    //         'project_description' => 'required|string',
    //         'project_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    //         'project_year' => 'required|integer',
    //         'student_id' => 'required|string|max:255',
    //         'advisor_id' => 'required|string|max:255',
    //     ]);

    //     // Handle the file upload (if an image was uploaded)
    //     if ($request->hasFile('project_img')) {
    //         $imageName = time().'.'.$request->project_img->extension();
    //         $request->project_img->move(public_path('images'), $imageName);
    //         $validated['project_img'] = $imageName;
    //     }

    //     // Save the project to the database
    //     Projects::create($validated);

    //     // Redirect back with success message
    //     return redirect()->route('admin/projects')->with('success', 'Project created successfully.');
    // }

    public function save(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'project_title' => 'required|string|max:255',
            'project_description' => 'required|string',
            'project_img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'project_year' => 'required|integer',
            'student_id' => 'required|integer',
            'advisor_id' => 'required|integer',
        ]);

        // Handle the file upload (if an image was uploaded)
        if ($request->hasFile('project_img')) {
            $imageName = time() . '.' . $request->project_img->extension();
            $request->project_img->move(public_path('images'), $imageName);
            $validated['project_img'] = $imageName;
        }

        // Save the project to the database
        $data = Projects::create($validated);

        // Redirect with a success or error message
        if ($data) {
            session()->flash('success', 'Project created successfully.');
            return redirect()->route('admin.projects');
        } else {
            session()->flash('error', 'An error occurred while creating the project.');
            return redirect()->route('admin.projects.create');
        }
    }

    public function edit($id)
    {
        $projects = Projects::findOrFail($id);
        return view('admin.projects.update', compact('projects'));
    }


    public function update(Request $request, $id)
    {
        $projects = Projects::findOrFail($id);

        // Validate the request inputs
        $request->validate([
            'project_title' => 'required|string',
            'project_description' => 'required|string',
            'project_year' => 'required|integer',
            'student_id' => 'required|integer',
            'advisor_id' => 'required|integer',
            'project_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
        ]);

        // Assign form values to the model fields
        $projects->project_title = $request->project_title;
        $projects->project_description = $request->project_description;
        $projects->project_year = $request->project_year;
        $projects->student_id = $request->student_id;
        $projects->advisor_id = $request->advisor_id;

        // Handle project image if uploaded
        if ($request->hasFile('project_img')) {
            $imageName = time() . '.' . $request->project_img->extension();
            $request->project_img->move(public_path('images'), $imageName);
            $projects->project_img = $imageName;
        }

        // Save the project and check if the save was successful
        $data = $projects->save();

        if ($data) {
            session()->flash('success', 'Project Updated Successfully');
            return redirect(route('admin.projects')); // Make sure you use the correct route name here
        } else {
            session()->flash('error', 'Some problem occurred');
            return redirect(route('admin.projects.edit', $id)); // Redirect to the edit form on failure
        }
    }

    public function delete($id)
    {
        $projects = Projects::findOrFail($id);
        $projects->delete();
        return redirect(route('admin.projects'));
    }
}
