<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'amount', 'claim'
    ];

    public function senderName()
    {
        return $this->hasOne(User::class, 'id', 'sender_id');
    }
}
