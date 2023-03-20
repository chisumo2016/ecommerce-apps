<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->when($this->name, $this->name),
            'email' => $this->when($this->email, $this->email),
            'is_email_verified'     => $this->when($this->email_verified_at, function () {
                return $this->email_verified_at !== null;
            }),

            'created_at_formatted'  => $this->when($this->created_at, function () {
                return $this->created_at->toDayDateTimeString();
            }),
            'roles'     => RoleResource::collection($this->whenLoaded('roles')),

            'can'       => [
                'edit' => $request->user()?->can('edit user'),
                'delete' => $request->user()?->can('delete user'),
            ],
        ];
    }
}
