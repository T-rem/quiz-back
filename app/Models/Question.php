<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'name',
        'answers'
    ];

    public function quiz() {
        return $this->belongsTo(Quiz::class);
    }

    public function answers(){
        return $this->hasMany(Answers::class, "question_id");
    }
}
