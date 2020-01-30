<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;

class ClubTransformers extends AbstractTransformer
{
    public function transformModel(Model $item)
    {
        $output = [
            'id'        => $item->id,
            'club_name' => $item->club_name,
        ];
        $output = $this->TransformToNotNull($output);

        return $output;
    }
}
