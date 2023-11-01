<?php

namespace App\Livewire;

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

    public function render()
    {

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

        Toaster::success('Feedback submitted successfully!');
        $this->resetForm();
        $this->render();
    }

    private function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->category = '';
    }

}
