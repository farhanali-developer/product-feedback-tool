<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FeedbackResponse;
use App\Models\Feedbacks;
use Masmerise\Toaster\Toaster;

class CommentResponse extends Component
{
    public $response_description;
    public $feedback_id;
    

    public $feedback;

    public function mount(Feedbacks $feedback)
    {
        $this->feedback = $feedback;
        $this->feedback_id = $feedback->id;
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

        FeedbackResponse::create([
            'user_id' => auth()->id(),
            'feedback_id' => $this->feedback_id,
            'description' => $this->response_description,
        ]);



        Toaster::success('Replied to a feedback successfully!');
        $this->resetForm();
        $this->dispatch('replySubmitted');
    }

    private function resetForm()
    {
        $this->feedback_id = '';
        $this->response_description = '';
    }
}
