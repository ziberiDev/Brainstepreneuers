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
        $applicant = User::where('id' , $this->user_id)->with('accademy')->get();
        return [
            'id' =>$this->id,
            'message'=>$this->message,
            'accepted' =>$this->accepted,
            'applicant' =>  ApplicantResource::collection($applicant)
        ];
    }
}
