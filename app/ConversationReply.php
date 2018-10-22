<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConversationReply extends Model
{
    public function conversation()
    {
        return $this->belongsTo('App\Conversation','conversation_id','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
