<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Feedbacks;
use App\Models\FeedbackResponse;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Masmerise\Toaster\Toaster;

class FeedbackComponent extends Component
{
    public $title;
    public $description;
    public $category;
    public $response_description;
    public $feedback_id;

    
    public function render()
    {
        // if (!Auth::check()) {
        //     return redirect('/login');
        // }


        $feedbacks = Feedbacks::with('user')
            ->where("visibility", true)
            ->latest()
            ->paginate(10);

        $feedbacksWithResponses = [];

        foreach ($feedbacks as $feedback) {
            $user = User::find($feedback->user_id);
            $feedbackResponse = FeedbackResponse::where('feedback_id', $feedback->id)->first();

            $feedbackData = [
                'feedback' => $feedback,
                'user' => $user,
                'response' => $feedbackResponse,
            ];
            array_push($feedbacksWithResponses, $feedbackData);
        }

        return view('livewire.feedback-component', compact('feedbacksWithResponses'));
    }

    public function submitFeedback()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
        ]);

        Feedbacks::create([
            'title' => $this->title,
            'description' => $this->description,
            'category' => $this->category,
            'user_id' => auth()->id(),
        ]);

        // $this->dispatch('show-success-toast', ['message' => 'Feedback submitted successfully!']);
        Toaster::success('Feedback submitted successfully!');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->category = '';
    }


    public function submitReply()
    {
        
        $this->validate([
            'feedback_id' => 'required|numeric',
            'response_description' => 'required|string'
        ]);

        Log::info("Feedback ID is: " . $this->feedback_id);
        Log::info("Feedback is: " . $this->feedback_id);

        // FeedbackResponse::create([
        //     'user_id' => auth()->id(),
        //     'feedback_id' => $this->feedback_id,
        //     'description' => $this->response_description,
        // ]);

        Toaster::success('Replied to a feedback successfully!');
    }
}
