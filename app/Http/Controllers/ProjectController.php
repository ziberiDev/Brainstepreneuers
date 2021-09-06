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
use App\Http\Requests\UpdateProjectrequest;
use App\Http\Resources\ProjectFilterResource;
use App\Models\AccademyProject;

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
     * Display a listing of the projects depending on requested accademies.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter($accademy_id)
    {
        $projects = Project::whereHas('accademies', function (Builder $query) use ($accademy_id) {
            $query->where('accademy_id', $accademy_id);
        })
            ->where('user_id', "!=", auth()->user()->id)
            ->with('accademies', 'owner')
            ->get();
        // return $projects;
        return response()->json(ProjectFilterResource::collection($projects));
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
    public function update(CreateProjectRequest $request, Project $project)
    {
        $updated = $project->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        if ($updated) {
            AccademyProject::where('project_id', $project->id)->delete();

            collect(explode(",", trim($request->accademies, "[ ]")))->each(function ($accademy_id) use ($project) {
                try {
                    AccademyProject::create([
                        'accademy_id' => $accademy_id,
                        'project_id' => $project->id
                    ]);
                } catch (\Illuminate\Database\QueryException $th) {
                    return abort(409, "Something went wrong");
                }
            });
            return response('Project Updated');
        }
        return abort(409, "Something went wrong");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return response('Project deleted');
        } catch (\LogicException $th) {
            return abort(409, "Something went wrong");
        }
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
