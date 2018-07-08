<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Tag as TagResource;
use App\Http\Resources\Ingredient as IngredientResource;

class Meal extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $status;
        if ($this->created_at == $this->updated_at && $this->deleted_at == null){
            $status = 'created';
        }
        elseif ($this->created_at < $this->updated_at && $this->deleted_at == null){
            $status = 'modified';
        }
        else{
            $status = 'deleted';
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,            
            'status' => $status,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients')),
        ];
    }
}
