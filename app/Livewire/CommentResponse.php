<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Feedbacks;
use App\Models\FeedbackResponse;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Masmerise\Toaster\Toaster;

class CommentResponse extends Component
{
    public $feedbackData;
    public $response_description;
    public $feedback_id;
    

    public function mount($feedbackData)
    {
        $this->feedbackData = $feedbackData;
        $this->feedback_id = $feedbackData['feedback']->id;
    }

    public function render()
    {
        return view('livewire.comment-response');
    }

    public function submitReply()
    {
        
        $this->validate([
            'feedback_id' => 'required|numeric',
            'response_description' => 'required|string'
        ]);

        Log::info("Feedback ID is: " . $this->feedback_id);
        Log::info("Feedback is: " . $this->response_description);

        FeedbackResponse::create([
            'user_id' => auth()->id(),
            'feedback_id' => $this->feedback_id,
            'description' => $this->response_description,
        ]);

        Toaster::success('Replied to a feedback successfully!');
        $this->render();
    }
}
