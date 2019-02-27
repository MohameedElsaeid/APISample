<?php

namespace App\Transformers;


use Illuminate\Database\Eloquent\Model;

class SessionTransformers extends AbstractTransformer
{
    public function transformModel(Model $item)
    {
        
        $output = [
            'id' => $item->id,
            'session_name' => $item->session_name,
            'session_description' => $item->session_description,
            'sport_name' => $item->sport->sport_name,
            'max_attendees' => $item->max_attendees,
            'current_attendees' => $item->current_attendees,
            'is_available' => (boolean)$item->is_available,
            
        ];
        $output = $this->TransformToNotNull($output);
        return $output;
    }
    
}