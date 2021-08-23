<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'owner' =>$this->owner->only(['first_name' , 'last_name' , 'accademy']),
            'description' => $this->description,
            'assebled' => $this->assebled,
            'applications' => $this->applications

        ];
    }
}
