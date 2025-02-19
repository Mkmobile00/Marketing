<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewReply extends Model
{
    use HasFactory;
    
    protected $fillable=[
        'review_id',
        'reply',
        'user_id',
        'status'
    ];
}
