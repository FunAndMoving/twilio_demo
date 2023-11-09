<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message_logs extends Model
{
    use HasFactory;
    protected $table= "message_logs";
    protected $fillable = [
         'user_id',
         'direction',
         'recipient',
         'message_body',
         'sender',
     ];
}
