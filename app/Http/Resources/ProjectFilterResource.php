<?php

namespace App\Http\Resources;

use App\Http\Resources\AccademyResource;
use App\Http\Resources\ApplicantResource;
use App\Http\Resources\ApplicationResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectFilterResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        self::wrap('projects');
        return [
            'id' => $this->id,
            'name' => $this->name,
            'owner' => [
                'id' => $this->owner->id,
                'first_name' => $this->owner->first_name,
                'last_name' => $this->owner->last_name,
                'accademy' => $this->owner->accademy,
                'image' => asset("storage/images/{$this->owner->image}")
            ],
            'description' => $this->description,
            'assembled' => $this->assembled,
            'applications_count' => $this->applications->count(),
            'applications' => ApplicationResource::collection($this->applications),
            'accademies' =>  AccademyResource::collection($this->accademies),

        ];
    }
}
