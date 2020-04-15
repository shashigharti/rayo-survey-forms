<?php

namespace Robust\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'contact' => $this->contact,
            'email' => $this->member->email ?? '',
            'user_name' => $this->member->user_name ?? '',
            'roles' =>$this->member ? $this->member->roles()->get()->pluck('id')->toArray() : [],
            'password' => '',
        ];
    }
}
