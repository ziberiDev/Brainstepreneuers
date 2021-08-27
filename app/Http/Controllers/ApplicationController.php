<?php

namespace App\Http\Controllers;

use App\Models\ProjectApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Delete the given application
     */
    public function cancel(ProjectApplication $application)
    {

        if (($application->accepted != 1) || ($application->accepted != 0)) {
            try {
                $application->delete();
                return response('Application canceled.');
            } catch (\LogicException $th) {
                return abort(409, "Something went wrong");
            }
        }
        return response('Application has been  accepted.');
    }

    /**
     * Accept the given application
     */
    public function accept(ProjectApplication $application)
    {

        if (($application->accepted === null)) {
            
            $updated = $application->update([
                'accepted' => 1
            ]);
            if ($updated) {
                return response('Application accepted.');
            }

            return abort(409, "Something went wrong");
        }
        return response('Application is allredy accepted.');
    }
}
