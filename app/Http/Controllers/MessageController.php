<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessageResource;
use App\Models\Channel;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function get(Request $request)
    {
        $messages = Message::query()
            ->with([
                'channels' => function ($query) {
                    $query->select('id', 'title');
                }
            ])->get();

        return $messages;
    }

    public function create(Request $request)
    {
        $request->validate([
            'text' => ['string', 'max:4096', 'required'],
            'channel_id' => ['integer', 'required']
        ]);

        $message = Message::query()
            ->create([
                'text' => $request->text,
                'channel_id' => $request->channel_id
            ]);

        return $message;

    }
}