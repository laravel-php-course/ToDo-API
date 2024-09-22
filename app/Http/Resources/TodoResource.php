<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
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
            'title' => $this->title ,
            'body'  => $this->body ,
            'status'  => $this->status ,
            'schedule_time'  => $this->schedule_time  ? $this->schedule_time : 'today',
            'user' => new UserResource(User::find($this->user_id))
        ];
    }
}
