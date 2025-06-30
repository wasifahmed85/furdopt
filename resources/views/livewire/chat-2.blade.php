<div class="flex">
    <!-- Left Sidebar (User List) -->
    <div class="w-1/3 p-4 border-r">
        <input type="text" wire:model.live="search" placeholder="Search users..." class="w-full p-2 border rounded mb-3">

        <ul>
            @foreach ($users as $user)
                <li class="p-2 border-b cursor-pointer hover:bg-gray-100" wire:click="selectUser({{ $user->id }})">
                    {{ $user->name }}
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Chat Area -->
    <div class="w-2/3 p-4">
        @if ($selectedUser)
            <div class="border-b pb-2 mb-3">
                <strong>Chat with {{ $selectedUser->name }}</strong>
            </div>

            <div class="h-64 overflow-y-auto border p-2 mb-3">
                @foreach ($messages as $chat)
                    <div class="{{ $chat->sender_id == auth()->id() ? 'text-right' : 'text-left' }}">
                        <div
                            class="inline-block p-2 border rounded mb-1 {{ $chat->sender_id == auth()->id() ? 'bg-blue-100' : 'bg-gray-100' }}">
                            @if ($chat->message)
                                {{ $chat->message }}
                            @endif
                            @if ($chat->file)
                                <a href="{{ asset('storage/' . $chat->file) }}" class="text-blue-500"
                                    target="_blank">View
                                    File</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex">
                <input type="text" wire:model="message" class="flex-1 p-2 border rounded"
                    placeholder="Type your message...">
                <input type="file" wire:model="file" class="p-2">
                <button wire:click="sendMessage" class="p-2 bg-blue-500 text-white rounded">Send</button>
                @if (session()->has('error'))
                    <div class="text-red-500">{{ session('error') }}</div>
                @endif
            </div>
        @else
            <p>Select a user to chat.</p>
        @endif
    </div>
</div>
