<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ClassDatum;
use App\Models\CreditedClass;
use App\Models\Post;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Nice;
use App\Models\QuestionNice;
use App\Models\AnswerNice;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function class_data() {
        return $this->hasMany(ClassDatum::class);
    }

    public function credited_classes() {
        return $this->hasMany(CreditedClass::class);
    }
    
    public function posts() {
        return $this->hasMany(Post::class);
    }
    
    public function questions() {
        return $this->hasMany(Question::class);
    }
    
    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function nices() {
        return $this->hasMany(Nice::class);
    }

    public function question_nices() {
        return $this->hasMany(QuestionNice::class);
    }

    public function answer_nices() {
        return $this->hasMany(AnswerNice::class);
    }
    
}

