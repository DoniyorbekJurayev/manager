<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChannelResource;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function get(Request $request)
    {

        $search = "%$request->search%";
        $channels = Channel::query()
            ->select(['id', 'title', 'chat_id'])
            ->where('title', 'ilike', $search)
            ->orWhere('chat_id', '=', $request->search)
            ->simplePaginate($request->per_page);
        return ChannelResource::collection($channels);
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => ['string', 'max:255', 'required'],
            'chat_id' => ['string', 'max:255', 'required', 'unique:channels,chat_id']
        ]);


        $channel = Channel::query()->create([
            "title" => $request->title,
            "chat_id" => $request->chat_id
        ]);
        return $channel;
    }

    public function update(Request $request, int $channelId)
    {
        $request->validate([
            'title' => ['string', 'max:255', 'required'],
            'chat_id' => ['string', 'max:255', 'required', 'unique:channels,chat_id,' . $channelId]
        ]);
        $channel = Channel::query()->find($channelId);

        Channel::query()
            ->where('id', '=', $channel->id)
            ->update([
                "title" => $request->title,
                "chat_id" => $request->chat_id,
            ]);


        return [
            ...$request->toArray(),
            "id" => $channel->id,
        ];
    }
    public function delete(int $channelId)
    {
        Channel::query()
            ->where("id", "=", $channelId)
            ->delete();
        return [
            "data" => [
                "message" => "deleted channel",
            ]
        ];
    }
}