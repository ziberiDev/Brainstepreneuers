<?php

namespace App\Http\Services;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\AccademyProject;
use Illuminate\Support\Collection;
use App\Http\Requests\CreateProjectRequest;


class ProjectService
{
    /**
     * Create project and tie accademies
     */
    public function createProject(Request $request): bool
    {
        try {
            $project = Project::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'description' => $request->description,

            ]);
            $accademies = $this->projectAccademiesRelation($project->id, collect(explode(",", $request->accademies)));
            return true;
        } catch (\Illuminate\Database\QueryException $th) {
            return false;
        }
    }

    /**
     * Tie the project to the requested accademies into accademy_projects table
     * 
     * @param int $projectID the created project ID
     * @param  \Illuminate\Support\Collection $accademies a collection from request accademies
     */
    private function projectAccademiesRelation(int $projectID, Collection $accademies)
    {

        $accademies->each(function ($accademyID) use ($projectID) {
            AccademyProject::create([
                'project_id' => $projectID,
                'accademy_id' => $accademyID
            ]);
        });

        return true;
    }

    /**
     * Assemble the given project
     * 
     */
    public function assembleProject(Project $project)
    {
        $project->update([
            'assembled' => 1
        ]);
    }
}
