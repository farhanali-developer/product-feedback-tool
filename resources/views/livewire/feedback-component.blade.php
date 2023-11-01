<div>
    <div class="flex mt-10">
        <!-- Feedback Form -->
        <div class="w-1/2 p-4 relative">
            <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto sticky top-0 z-1000">
                <div class="mx-auto max-w-2xl">
                    <div class="text-center">
                        <h2 class="text-xl text-gray-800 font-bold sm:text-3xl dark:text-white">
                            Publish your feedback
                        </h2>
                    </div>
                    <div class="mt-5 p-4 relative z-10 bg-white border rounded-xl sm:mt-10 md:p-10 dark:bg-gray-800 dark:border-gray-700">
                        <form wire:submit.prevent="submitFeedback">
                            <div class="mb-4 sm:mb-8">
                                <label for="title" class="block mb-2 text-sm font-medium dark:text-white">Title <span class="text-red-600">*</span></label>
                                <input wire:model.lazy="title" type="text" id="title" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 sm:p-4 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400" placeholder="Title">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
            
                            <div class="mb-4 sm:mb-8">
                                <label for="description" class="block mb-2 text-sm font-medium dark:text-white">Description <span class="text-red-600">*</span></label>
                                <textarea wire:model.lazy="description" id="description" rows="3" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 sm:p-4 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400" placeholder="Description"></textarea>
                                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
            
                            <div class="mb-4 sm:mb-8">
                                <label for="category" class="block mb-2 text-sm font-medium dark:text-white">Category <span class="text-red-600">*</span></label>
                                <select wire:model.lazy="category" id="category" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 sm:p-4 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                                    <option value="">Select Category</option>
                                    <option value="bug">Bug</option>
                                    <option value="feature-request">Feature Request</option>
                                    <option value="improvement">Improvement</option>
                                </select>
                                @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
            
                            <div class="mt-6 grid">
                                <button type="submit" class="py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border border-transparent font-semibold bg-blue-500 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all dark:focus:ring-offset-gray-800">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Feedback List -->
        <div class="w-1/2 p-4">
            <div class="container px-0 mx-auto sm:px-5">
                <div class="text-center">
                    <h2 class="text-xl text-gray-800 font-bold sm:text-3xl dark:text-white">
                        All Feedbacks
                    </h2>
                </div>
                @foreach($feedbacksWithResponses as $feedbackData)
                <div class="flex-col w-full py-4 mx-auto bg-white border rounded-xl sm:mt-10 md:p-10 dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex flex-row">
                        {{-- <img class="object-cover w-12 h-12 border-2 border-gray-300 rounded-full" alt="Noob master's avatar" src="https://images.unsplash.com/photo-1517070208541-6ddc4d3efbcb?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&faces=1&faceindex=1&facepad=2.5&w=500&h=500&q=80"> --}}
                        <svg class="object-cover w-12 h-12 border-2 border-gray-300 rounded-full" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:#606161;}</style></defs><title/><g data-name="Layer 7" id="Layer_7"><path class="cls-1" d="M19.75,15.67a6,6,0,1,0-7.51,0A11,11,0,0,0,5,26v1H27V26A11,11,0,0,0,19.75,15.67ZM12,11a4,4,0,1,1,4,4A4,4,0,0,1,12,11ZM7.06,25a9,9,0,0,1,17.89,0Z"/></g></svg>
                        <div class="flex-col mt-1 ml-2">
                            <div class="flex items-center flex-1 px-4 font-bold leading-tight dark:text-white">{{ $feedbackData['user']->name }}
                                <span class="ml-2 text-xs font-normal text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($feedbackData['feedback']->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="flex-1 px-2 ml-2 text-sm font-medium leading-loose text-gray-600 dark:text-gray-400">{{ $feedbackData['feedback']->description }}</div>
                            <button class="inline-flex items-center px-1 pt-2 ml-1 flex-column" id="reply-back" onclick="openModal('{{ $feedbackData['feedback']->id }}', '{{ $feedbackData['feedback']->title }}')">
                                <svg class="w-5 h-5 ml-2 text-gray-600 cursor-pointer fill-current hover:text-gray-900"
                                    viewBox="0 0 95 78" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M29.58 0c1.53.064 2.88 1.47 2.879 3v11.31c19.841.769 34.384 8.902 41.247 20.464 7.212 12.15 5.505 27.83-6.384 40.273-.987 1.088-2.82 1.274-4.005.405-1.186-.868-1.559-2.67-.814-3.936 4.986-9.075 2.985-18.092-3.13-24.214-5.775-5.78-15.377-8.782-26.914-5.53V53.99c-.01 1.167-.769 2.294-1.848 2.744-1.08.45-2.416.195-3.253-.62L.85 30.119c-1.146-1.124-1.131-3.205.032-4.312L27.389.812c.703-.579 1.49-.703 2.19-.812zm-3.13 9.935L7.297 27.994l19.153 18.84v-7.342c-.002-1.244.856-2.442 2.034-2.844 14.307-4.882 27.323-1.394 35.145 6.437 3.985 3.989 6.581 9.143 7.355 14.715 2.14-6.959 1.157-13.902-2.441-19.964-5.89-9.92-19.251-17.684-39.089-17.684-1.573 0-3.004-1.429-3.004-3V9.936z"
                                        fill-rule="nonzero" />
                                </svg>
                            </button>
                            <button class="inline-flex items-center px-1 -ml-1 flex-column">
                                <svg class="w-5 h-5 text-gray-600 cursor-pointer hover:text-gray-700" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5">
                                    </path>
                                </svg>
                            </button>
                            <form id="replyForm" wire:submit.prevent="submitReply">
                                Reply to {{ $feedbackData['feedback']->id }}
                                <input type="hidden" wire:modal="feedback_id" value="{{ $feedbackData['feedback']->id }}" disabled />
                                <div class="mb-4">
                                    {{-- <label for="response_description" class="block text-sm font-medium text-gray-600">Description</label> --}}
                                    <textarea wire:model.lazy="response_description" id="response_description" name="response_description" rows="3" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 sm:p-4 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400" placeholder="Description"></textarea>
                                </div>
                                
                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded">Submit</button>
                            </form>
                        </div>
                    </div>
                            <!-- Modal -->
                    {{-- <div id="modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                        <div class="modal-container bg-white w-96 mx-auto rounded shadow-lg p-8 relative">
                            <!-- Close Button (Cross Icon) -->
                            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                            <h2 class="text-xl font-semibold mb-4" id="feedback-title">Reply to {{ $feedbackData['feedback']->title }}</h2>
                            <form id="replyForm" wire:submit.prevent="submitReply">
                                <input type="number" wire:modal.lazy="feedback_id" value="{{ $feedbackData['feedback']->id }}" disabled />
                                <div class="mb-4">
                                    <label for="response_description" class="block text-sm font-medium text-gray-600">Description</label>
                                    <textarea wire:model.lazy="response_description" id="response_description" name="response_description" rows="4" class="mt-1 p-2 w-full border rounded focus:ring-indigo-500 focus:border-indigo-500" required></textarea>
                                </div>
                                
                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded">Submit</button>
                            </form>
                        </div>
                    </div> --}}

                    @if($feedbackData['response'])
                    <hr class="my-2 ml-16 border-gray-200">
                    <div class="flex flex-row pt-1 md-10 md:ml-16">
                        {{-- <img class="w-12 h-12 border-2 border-gray-300 rounded-full" alt="Emily's avatar" src="https://images.unsplash.com/photo-1581624657276-5807462d0a3a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&fit=facearea&faces=1&faceindex=1&facepad=2.5&w=500&h=500&q=80"> --}}
                        <svg class="object-cover w-12 h-12 border-2 border-gray-300 rounded-full" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><defs><style>.cls-1{fill:#606161;}</style></defs><title/><g data-name="Layer 7" id="Layer_7"><path class="cls-1" d="M19.75,15.67a6,6,0,1,0-7.51,0A11,11,0,0,0,5,26v1H27V26A11,11,0,0,0,19.75,15.67ZM12,11a4,4,0,1,1,4,4A4,4,0,0,1,12,11ZM7.06,25a9,9,0,0,1,17.89,0Z"/></g></svg>
                        <div class="flex-col mt-1 ml-2">
                            <div class="flex items-center flex-1 px-4 font-bold leading-tight dark:text-white">{{ $feedbackData['user']->name }}
                                <span class="ml-2 text-xs font-normal text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($feedbackData['response']->created_at)->diffForHumans() }}</span>
                            </div>
                            <div class="flex-1 px-2 ml-2 text-sm font-medium leading-loose text-gray-600 dark:text-gray-400">{{ $feedbackData['response']->description }}</div>
                            <button class="inline-flex items-center px-1 pt-2 ml-1 flex-column">
                                <svg class="w-5 h-5 ml-2 text-gray-600 cursor-pointer fill-current hover:text-gray-900"
                                    viewBox="0 0 95 78" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M29.58 0c1.53.064 2.88 1.47 2.879 3v11.31c19.841.769 34.384 8.902 41.247 20.464 7.212 12.15 5.505 27.83-6.384 40.273-.987 1.088-2.82 1.274-4.005.405-1.186-.868-1.559-2.67-.814-3.936 4.986-9.075 2.985-18.092-3.13-24.214-5.775-5.78-15.377-8.782-26.914-5.53V53.99c-.01 1.167-.769 2.294-1.848 2.744-1.08.45-2.416.195-3.253-.62L.85 30.119c-1.146-1.124-1.131-3.205 .032-4.312L27.389.812c.703-.579 1.49-.703 2.19-.812zm-3.13 9.935L7.297 27.994l19.153 18.84v-7.342c-.002-1.244.856-2.442 2.034-2.844 14.307-4.882 27.323-1.394 35.145 6.437 3.985 3.989 6.581 9.143 7.355 14.715 2.14-6.959 1.157-13.902-2.441-19.964-5.89-9.92-19.251-17.684-39.089-17.684-1.573 0-3.004-1.429-3.004-3V9.936z"
                                        fill-rule="nonzero" />
                                </svg>
                            </button>
                            <button class="inline-flex items-center px-1 -ml-1 flex-column">
                                <svg class="w-5 h-5 text-gray-600 cursor-pointer hover:text-gray-700"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
                {{-- {{ $feedbacks->links() }} --}}
            </div>
        </div>



        <script>
            function openModal(feedbackId, feedbackTitle) {
                // console.log(feedbackId);
                document.getElementById('modal').classList.remove('hidden');
                // document.querySelector('input[name="feedback_id"]').setAttribute(':value', feedbackId);
                // document.getElementById('feedback-title').innerHTML = "Reply to " + feedbackTitle;
            }

            function closeModal() {
                document.getElementById('modal').classList.add('hidden');
            }
        
            document.getElementById('replyForm').addEventListener('submit', function(event) {
                closeModal();
            });

            document.getElementById('replyForm').addEventListener('submit', function(event) {
  // Prevent the default form submission behavior.
  event.preventDefault();

  // Get all the input fields in the form.
  const inputFields = event.target.querySelectorAll('input,textarea');

  // Create an object to store the input field data.
  const formData = {};

  // Loop through the input fields and add their data to the formData object.
  for (const inputField of inputFields) {
    formData[inputField.name] = inputField.value;
  }

  // Display the input field data in the console log.
  console.log(formData);
});
        </script>
    </div>
</div>