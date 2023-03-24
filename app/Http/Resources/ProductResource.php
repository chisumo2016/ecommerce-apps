<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->whenNotNull($this->name),
            'slug' => $this->whenNotNull($this->slug),
            'description' => $this->whenNotNull($this->description),
            'cost_price' => $this->whenNotNull($this->cost_price),
            'price' => $this->whenNotNull($this->price),
            'featured' => $this->whenNotNull($this->featured),
            'show_on_slider' => $this->whenNotNull($this->show_on_slider),
            'active' => $this->whenNotNull($this->active),
            'created_at_formatted' => $this->when($this->created_at, function () {
                return $this->created_at->toDayDateTimeString();
            }),

            'categories' => CategoryResource::collection($this->whenLoaded('categories')),

            'category_id' => $this->whenLoaded(
                'categories',
                fn () => $this->categories->firstWhere('parent_id', null)?->id,
            ),
            'sub_category_id' => $this->whenLoaded(
                'categories',
                fn () => $this->categories->firstWhere('parent_id', '!=', null)?->id,
            ),

            'can' => [
                'edit' => $request->user()?->can('update',   $this->resource),
                'delete' => $request->user()?->can('delete', $this->resource),
            ],

            'images' => $this->whenLoaded(
      'media',
                 fn() => $this->getMedia()->map(  //getMedia() will return all the media from default collection OR media relationship
                     fn($media) => [
                         'id'   => $media->id,
                         'html' =>$media->toHtml(),
                     ]
                 )

            )
        ];
    }
}
