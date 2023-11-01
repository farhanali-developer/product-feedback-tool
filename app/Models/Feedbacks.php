<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\FeedbackResponse;

class Feedbacks extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'category',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function feedbackResponse()
    {
        return $this->hasOne(FeedbackResponse::class, 'feedback_id', 'id');
    }
}
