<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    public function conversationreply(){
        return $this->hasMany('App\ConversationReply','conversation_id','id');
       
    }

    public function workshoporder(){
        return $this->belongsTo('App\WorkShopOrder','order_id','order_id');
    }

    public function userone(){
        return $this->belongsTo('App\User','id');
    }

    public function usertwo(){  
        return $this->belongsTo('App\User','id');
    }

}
