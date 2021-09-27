<?php

namespace App\Http\Resources;

use App\Http\Resources\SkillResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'biography' => $this->biography,
            'image' => asset("storage/images/{$this->image}"),
            'accademy' => new AccademyResource($this->accademy),
            'skills' => SkillResource::collection($this->skills),
        ];
    }
}
