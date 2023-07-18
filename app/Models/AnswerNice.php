<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Answer;

class AnswerNice extends Model
{
    use HasFactory;

    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answer() {
        return $this->belongsTo(Answer::class);
    }
}
