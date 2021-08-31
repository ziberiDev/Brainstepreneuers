<?php

namespace App\Http\Resources;

use App\Http\Resources\SkillResource;
use App\Http\Resources\AccademyResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' =>$this->id,
            'first_name' => $this->first_name,
            'last_name'=> $this->last_name,
            'email' => $this->email,
            'biography' =>$this->biography,
            'image' => asset("storage/images/{$this->image}"),
            'accademy' => new AccademyResource($this->accademy),
            "skills" => SkillResource::collection($this->skills),
            'registered' => $this->registered,
            'step' => $this->step
          
        ];
    }
}
