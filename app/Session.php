<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['current_attendees'];
    
    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }
    
    public function incrementCurrentAttendees()
    {
        return $this->increment('current_attendees', 1);
    }
    
    public function check()
    {
        if ($this->current_attendees == $this->max_attendees)
            return true;
    }
    
    public function checkIfBooked($userID)
    {
        if (UserSessions::query()->where('user_id',$userID)->where('session_id',$this->id)->first())
            return true;
    }
}
