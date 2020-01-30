<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;

class SportTransformers extends AbstractTransformer
{
    public function transformModel(Model $item)
    {
        $output = [
            'id'         => $item->id,
            'sport_name' => $item->sport_name,
        ];
        $output = $this->TransformToNotNull($output);

        return $output;
    }
}
