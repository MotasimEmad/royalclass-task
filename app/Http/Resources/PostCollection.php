<?php

namespace App\Http\Resources;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "post_content" => $this->post_content,
            "created_at" => $this->created_at,
            "user" => UserCollection::collection(User::where('id', $this->user_id)->get())->first()
        ];
    }
}
