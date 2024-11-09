<div class="mb-5">
    <form wire:submit.prevent="submit">
        <div class="mb-6">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Your name</label>
            <input wire:model="name" type="text" id="name" class="shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-solid border-1 border-red-800 @else border-gray-300 @enderror" placeholder="John Smith" required />
            <div>
                @error('name') <span class="absolute text-red-800">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
            <input wire:model="email" type="email" id="email" class="shadow-sm bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('email') border-solid border-1 border-red-800 @else border-gray-300 @enderror" placeholder="name@gmail.com" required />
            <div>
                @error('email') <span class="absolute text-red-800">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mb-6">
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900">Your message</label>
            <textarea wire:model="message" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border focus:ring-blue-500 focus:border-blue-500 @error('message') border-solid border-1 border-red-800 @else border-gray-300 @enderror" placeholder="Leave a message..."></textarea>
            <div>
                @error('message') <span class="absolute text-red-800">{{ $message }}</span> @enderror
            </div>
        </div>
        <button type="submit" class="w-full sm:w-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Send Message</button>
    </form>
</div>

