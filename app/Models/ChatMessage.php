<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'chat_room_id',
        'message',
        'sender'
    ];

        /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'sender' => 'boolean',
    ];

    // room relation
    public function room() {
        // return $this->belongsTo(ChatRoom::class);
        return $this->hasOne(ChatRoom::class, 'id', 'chat_room_id');

    }
    // user relation
    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
