<?php

namespace Theme\Jobzilla\Http\Resources;

use Botble\Blog\Models\Post;
use Botble\Media\Facades\RvMedia;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

/**
 * @mixin Post
 */
class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'description' => Str::limit($this->description, 150),
            'image' => RvMedia::getImageUrl($this->image, 'small', false, RvMedia::getDefaultImage()),
            'created_at' => $this->created_at->translatedFormat('M d, Y'),
            'views' => number_format($this->views),
            'author_name' => $this->author->name,
        ];
    }
}
