<?php

namespace Robust\Admin\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_name' => $this->user_name,
            'contact' => $this->contact,
            'email' => $this->email,
            'password' => '',
            'avatar' => $this->avatar,
            'roles' => UserRolesResource::collection($this->whenLoaded('roles')),
            'permissions' => RolePermissionResource::collection($this->whenLoaded('roles.permissions')),
            'password_confirmation'=>''
        ];
    }
}
