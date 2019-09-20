<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class TaskResource extends JsonResource
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
            'id'       => $this->id,
            'name'     => $this->name,
            'due_date' => Carbon::parse($this->due_date),
            'status'   => (int) $this->status,
            'point'    => (int) $this->point,
            'type_id'  => (int) $this->type_id,
            'user_id'  => (int) $this->user_id,
        ];
    }
}
