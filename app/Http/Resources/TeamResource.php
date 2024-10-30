<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $arr = [
            'id' => $this->id,
            'name' => $this->name,
            'role' => $this->role,
            'image' => Storage::url('upload/teams/' . $this->image),
            'position' => $this->position,
            'bio' => $this->bio,
        ];

        if ($this->role == 'adviser')
            $arr['provide'] = $this->provide;

        $arr['linkedin_url'] = $this->linkedin_url;
        $arr['created_at'] = $this->created_at ? $this->created_at->toDateTimeString() : null;
        $arr['updated_at'] = $this->updated_at ? $this->updated_at->toDateTimeString() : null;

        return $arr;
    }
}
