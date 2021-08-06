<?php

namespace App\Activity;

use Auth;
use App\Candidatemaster;
use App\Activity;

class UpdateActivity
{
   
    public function __construct()
    {
//        $this->id = $id;
//        $this->message = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function updateActivity($id,$message)
    {
       
         $user = Candidatemaster::where('id', $id)->get()->first();
         
       $flag =   \App\Activity::create(
                    array(
                        'CandidateId'=>$user->id,
                        'OrgID'=>$user->OrgID,
                        'JobID'=>$user->JobID,
                        'message'=>$message,
                        'CreatedBy'=>Auth::user()->id,
                        )
                    );
        
        return $flag;
       // return $this->message;
        //save activity
    }
}
