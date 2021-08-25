<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\ProjectApplication;
use App\Http\Services\ProjectService;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\ApplicationRequest;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\CreateProjectRequest;

class ProjectController extends Controller
{


    /**
     * service of this controller
     * @property $service
     */
    protected $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        // Create project and tie with accademy_projects (use service)

        if ($this->service->createProject($request)) {
            return response()->json(['message' => 'Project Created']);
        }
        return abort(409, 'could not create project.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return new ProjectResource($project->fresh(['owner', 'applications']));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    /**
     * Get the Projects of specified user
     */
    public function userprojects()
    {
        return ProjectResource::collection(Project::where('user_id', auth()->user()->id)
            ->with('owner')
            ->get());
    }

    /**
     * Apply for the certain Project
     * 
     * @param int $id The id of the project
     * @param \App\Http\Requests\ApplicationRequest $request
     */
    public function apply(int $id, ApplicationRequest $request)
    {
        try {
            ProjectApplication::create([
                'project_id' => $id,
                'user_id' => auth()->user()->id,
                'message' => $request->message
            ]);
            return response()->json('Application submited.');
        } catch (\Illuminate\Database\QueryException $th) {
            return abort(409, 'could not apply to the project.');
        }
    }

    /**
     * Assemble the selected project
     * 
     * 
     */
    public function assemble(Project $project)
    {
        if ($project->assembled === 0) {
            $project->assembled = 1;
            if ($project->save()) {
                $unacceptedApplications = ProjectApplication::where('project_id', $project->id)->where('accepted', null)->get();
                $unacceptedApplications->each(function ($application) {
                    $application->update([
                        'accepted' => 0
                    ]);
                });
                return response('Project Assembled.', 200);
            }
            return response('Project could not be assemled', 500);
        }
        return response('Project Alredy Assembled');
    }
}
