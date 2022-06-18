<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Accademy;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $applicant = User::with('accademy')->findOrFail($this->user_id);
        return [
            'id' => $this->id,
            'message' => $this->message,
            'accepted' => $this->accepted,
            'student' =>  new ApplicantResource($applicant)
        ];
    }
}
