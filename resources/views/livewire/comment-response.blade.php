<div>
    <form id="replyForm" wire:submit="submitReply">
        Reply to {{ $feedbackData['feedback']->title }}
        <input type="hidden" wire:model.defer="feedback_id" :value="{{ $feedbackData['feedback']->id }}" />
        <div class="mb-4">
            <label for="response_description" class="block text-sm font-medium text-gray-600">Description</label>
            <textarea wire:model.live="response_description" id="response_description" name="response_description" rows="3" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 sm:p-4 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400" placeholder="Description"></textarea>
        </div>
        
        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded">Submit</button>
    </form>
</div>