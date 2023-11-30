<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageStoreRequest;
use App\Http\Resources\MessageCollection;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class MessageController extends Controller
{

    public function index()
    {
        $with = [];

        if (isset($_GET['garden']))    {

            $with[] = 'garden';
        }

        if (isset($_GET['user']))    {

            $with[] = 'user';
        }

        $messages = QueryBuilder::for(Message::with($with))->paginate();

        return new MessageCollection($messages);
    }

    public function store(MessageStoreRequest $request)
    {
        $validated = $request->validated();

        $message = Message::create($validated);

        return new MessageResource($message);
    }

    public function show(Request $request, Message $message)
    {
        if (isset($_GET['garden'])) {

            $message->load('garden');
        }

        if (isset($_GET['user']))    {

            $message->load('user');
        }

        return new MessageResource($message);
    }

    public function destroy(Request $request, Message $message)
    {
        $message->delete();

        return response()->noContent();
    }
}
