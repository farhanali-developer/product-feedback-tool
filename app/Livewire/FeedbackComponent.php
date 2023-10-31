<?php

// namespace App\Http\Livewire;
namespace App\Livewire;

use Livewire\Component;
use App\Models\Feedbacks;
use Masmerise\Toaster\Toaster;

class FeedbackComponent extends Component
{
    public $title;
    public $description;
    public $category;

    public function render()
    {
        return view('livewire.feedback-component', [
            'feedbacks' => Feedbacks::with('user')
            ->where("visibility", true)
            ->latest()
            ->paginate(10),
        ]);
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
}
