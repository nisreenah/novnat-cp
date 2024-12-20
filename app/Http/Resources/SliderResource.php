<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class SliderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'media' => Storage::url('upload/sliders/' . $this->media),
            'desc' => $this->desc,
            'extra_desc' => $this->extra_desc,
            'youtube_video_url' => $this->youtube_video_url,
            'youtube_video_title' => $this->youtube_video_title,
            'about_youtube_video' => $this->about_youtube_video,
            'cover_youtube_image' => Storage::url('upload/sliders/' . $this->cover_youtube_image),
            'created_at' => $this->created_at ? $this->created_at->toDateTimeString() : null,
            'updated_at' => $this->updated_at ? $this->updated_at->toDateTimeString() : null,
        ];
    }
}
