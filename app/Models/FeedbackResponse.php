<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Feedbacks;

class FeedbackResponse extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'feedback_id',
        'description',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function feedback()
    {
        return $this->belongsTo(Feedbacks::class, 'feedback_id', 'id');
    }


}
