<div class="flex-1 flex flex-col min-h-0 w-full rounded-2xl">
    <!-- Header -->
    <div class="h-[70px] px-4 border-b border-gray-300 flex items-center gap-3 bg-[#E7F3F2]  flex-shrink-0 rounded-tr-2xl">
        @php
            $selectedName = $chat->admin_id == auth()->id()
                ? $chat->supportStaff->name
                : $chat->admin->name;
        @endphp

        <div class="w-10 h-10 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-sm font-bold">
            {{ strtoupper(substr($selectedName, 0, 1)) }}
        </div>
        <div>
            <p class="font-semibold text-gray-800 truncate">{{ $selectedName }}</p>
            <p class="text-xs text-gray-500">Online</p>
        </div>
    </div>


    <!-- Messages -->
    <div id="chat-messages" class="flex-1 p-4 overflow-y-auto space-y-3 bg-[#F2FAF9] bg-opacity-100" >
        @if($messages->count())
            @php $lastTimestamp = null; @endphp
            @foreach($messages as $message)
                @php
                    $currentTimestamp = \Carbon\Carbon::parse($message->created_at)->format('Y-m-d h:i A');
                    $showTimestamp = $lastTimestamp !== $currentTimestamp;
                    $lastTimestamp = $currentTimestamp;
                    $isQuickReply = str_contains($message->message, 'quick-reply');
                    $bubbleClass = $isQuickReply 
                        ? 'bg-transparent'
                        : ($message->user_id === auth()->id() 
                            ? 'bg-[#4C956C] text-white px-4 py-2 rounded-2xl'
                            : 'bg-gray-200 text-gray-800 px-4 py-2 rounded-2xl');
                @endphp

                @if($showTimestamp)
                    <div class="flex justify-center">
                        <span class="text-gray-500 text-xs px-3 py-1">
                            {{ $message->created_at->format('M d, Y h:i A') }}
                        </span>
                    </div>
                @endif

                <div class="flex items-end gap-2 {{ $message->user_id === auth()->id() ? 'justify-end' : '' }}">
                    @if($message->user_id !== auth()->id())
                        <div class="w-9 h-9 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-sm font-bold">
                            {{ strtoupper(substr($message->user->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif

                    <div class="{{ $bubbleClass }} text-sm md:text-md max-w-[80%] break-words">
                        {!! $message->message !!}
                    </div>

                    @if($message->user_id === auth()->id())
                        <div class="w-9 h-9 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-sm font-bold">
                            {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="text-sm text-gray-500 text-center bottom-0">No messages yet. Start the conversation!</div>
        @endif
    </div>

<!-- Quick Replies -->
<div class="flex gap-2 p-3 border-t border-gray-200 bg-white overflow-x-auto flex-shrink-0 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200 min-h-[2px]">
    @foreach($quickReplies as $reply)
        <button 
            class="bg-gray-200 px-3 py-1 rounded-full text-sm md:text-md hover:bg-gray-300 whitespace-nowrap quick-reply-btn"
            data-question="{{ htmlspecialchars($reply->question, ENT_QUOTES, 'UTF-8') }}"
            data-answer="{{ htmlspecialchars($reply->answer, ENT_QUOTES, 'UTF-8') }}"
            onclick="sendQuickReply(this)">
            {{ $reply->question }}
        </button>
    @endforeach

    <!-- Manage Button (pushed to the right) -->
    <button class="ml-auto bg-[#4C956C] text-white px-4 py-1 rounded-full text-sm md:text-md hover:bg-[#3d7e59] whitespace-nowrap">
        Manage
    </button>
</div>


    <!-- Input -->
    <div class="w-full border-t border-gray-200 p-2 flex items-center gap-2 bg-white flex-shrink-0">
        <input 
            id="chat-input" 
            type="text" 
            placeholder="Type a message..."
            class="pl-4 flex-1 p-2 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#4C956C] text-sm md:text-base">
        <button 
            id="send-btn" 
            class="bg-[#4C956C] hover:bg-[#2C6E49] text-white px-3 md:px-4 py-2 rounded-full flex items-center justify-center">
            <i class="material-icons text-white text-lg">send</i>
        </button>
    </div>
</div>
