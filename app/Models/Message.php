<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Enums\Status;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['text', 'channel_id'];
    protected $casts = ["Status" => Status::class];
    public function channels(): BelongsTo
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');

    }
}