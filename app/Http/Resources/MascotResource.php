<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MascotResource extends JsonResource
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
            'id'    => $this->id,
            'exp'   => $this->exp,
            'level' => $this->level,
        ];
    }
}
