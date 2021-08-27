<?php

namespace App\Http\Resources;

use App\Http\Resources\AccademyResource;
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
        return [
            'id' => $this->id,
            'name' =>$this->name,
            'owner' => [
                'id' =>$this->owner->id,
                'first_name' =>$this->owner->first_name,
                'last_name' =>$this->owner->last_name,
                'accademy' =>$this->owner->accademy,
                'image' => asset("storage/images/{$this->owner->image}")
            ],
            'description' => $this->description,
            'assembled' => $this->assembled,
            'applications' => $this->applications->count(),
            'accademies' =>  AccademyResource::collection($this->accademies)

        ];
    }
}
