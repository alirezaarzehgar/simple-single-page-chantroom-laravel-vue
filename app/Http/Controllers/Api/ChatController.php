<?php

namespace App\Http\Controllers\Api;

use App\Events\ActiveEvent;
use App\Events\Message;
use App\Http\Controllers\Controller;
use App\Models\Active;
use App\Models\Message as ModelsMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function addMessage(Request $request)
    {
        $msg = $request->message;
        $id = $request->userId;

        ModelsMessage::forceCreate([
            'message' => $msg,
            'user_id' => $id
        ]);

        event(
            (new Message($msg, $id))->dontBroadcastToCurrentUser()
        );

        return ['status' => 'success'];
    }

    public function getAllMessages()
    {
        return ModelsMessage::with('user')->get();
    }

    public function getUser($id)
    {
        return User::find($id);
    }

    public function getAllActives()
    {
        return Active::all();
    }

    public function deleteCurrentUser(Request $request)
    {
        $name = User::where('id', $request->userId)->first()->name;
        $activeUser = Active::where('user', $name)->first();

        if (!empty($activeUser)) {
            $activeUser->delete();
            event(new ActiveEvent($name, true));
        }
    }
}
