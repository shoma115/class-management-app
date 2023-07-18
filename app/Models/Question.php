<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Answer;
use App\Models\QuestionNice;

class Question extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function question_nices() {
        return $this->hasMany(QuestionNice::class);
    }
}
