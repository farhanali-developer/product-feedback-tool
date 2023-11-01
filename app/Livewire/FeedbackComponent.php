<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Feedbacks;
use App\Models\FeedbackResponse;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Masmerise\Toaster\Toaster;
use Livewire\WithPagination;

class FeedbackComponent extends Component
{
    public $title;
    public $description;
    public $category;
    public $response_description;
    public $commentResponses = [];

    use WithPagination;
    
    public function render()
    {
        $feedbacks = Feedbacks::with('user', 'feedbackResponse')
            ->where("visibility", true)
            ->latest()
            ->get();
            // ->paginate(2);

        return view('livewire.feedback-component', compact('feedbacks'));
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
