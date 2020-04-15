<?php

namespace Robust\Core\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Setting extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'package_name' => $this->package_name,
            'display_name' => $this->display_name,
            'values' => json_decode($this->values, true),
        ];
    }
}
