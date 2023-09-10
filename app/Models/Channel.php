<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'chat_id'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}