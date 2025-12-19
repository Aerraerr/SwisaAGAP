
<style>
/* ===== MESSAGE BUBBLES ===== */
.message-bubble {
    padding: 10px 14px;
    border-radius: 14px;
    word-wrap: break-word;
    overflow-wrap: break-word;
    max-width: 70%; /* Adjust for consistent width */
    min-width: 30%; /* Keeps short messages wide enough */
    width: fit-content;
}

/* ===== FOR LONG MESSAGES: LIMIT MAX WIDTH ===== */
@media (min-width: 768px) {
    .message-bubble {
        max-width: 60%; /* Slightly narrower for larger screens */
    }
}

/* ===== QUICK REPLY (BOT) BUBBLE STYLE ===== */
.bot-reply-bubble {
    width: 50%;
    background: #e6f4ea;
    border-left: 4px solid #4C956C;
    color: #1a6334;
    font-style: italic;
    padding: 10px 14px;
    border-radius: 14px;
    max-width: 50%;
    min-width: 30%;
    font-size: 0.95rem;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.bot-reply-label {
    font-weight: 600;
    font-style: normal;
    color: #2C6E49;
    font-size: 0.8rem;
    margin-bottom: 4px;
    display: block;
}

</style>

<div class="flex-1 flex flex-col h-full w-full rounded-2xl bg-white">
    <!-- Header -->
    <div class="h-[70px] px-4 border-b border-gray-300 flex items-center gap-3 bg-[#E7F3F2] flex-shrink-0 rounded-tr-2xl">
        @php
            $selectedUser = $chat->admin_id == auth()->id()
                ? $chat->supportStaff
                : $chat->admin;
            $selectedName = trim(($selectedUser->first_name ?? '') . ' ' . ($selectedUser->last_name ?? ''));
        @endphp

        <div class="w-10 h-10 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-sm font-bold">
            {{ strtoupper(substr($selectedUser->first_name ?? 'U', 0, 1)) }}
        </div>
        <div>
            <p class="font-semibold text-gray-800 truncate">{{ $selectedName ?: 'Unknown User' }}</p>
            <p class="text-xs text-gray-500">Online</p>
        </div>
    </div>



    <!-- Messages (scrollable) -->
    <div id="chat-messages" class="flex-1 overflow-y-auto p-4 space-y-3 bg-[#F2FAF9] rounded-tr-2xl">
        @if($messages->count())
            @php $lastTimestamp = null; @endphp
            @foreach($messages as $message)
                @php
                    $currentTimestamp = \Carbon\Carbon::parse($message->created_at)->format('Y-m-d h:i A');
                    $showTimestamp = $lastTimestamp !== $currentTimestamp;
                    $lastTimestamp = $currentTimestamp;

                    // Detect if message is a Quick Reply
                    $isQuickReply = str_contains($message->message, 'quick-reply');

                    // Assign bubble class
                    if ($isQuickReply) {
                        $bubbleClass = 'bot-reply-bubble';
                    } elseif ($message->user_id === auth()->id()) {
                        $bubbleClass = 'bg-[#4C956C] text-white px-4 py-2 rounded-2xl';
                    } else {
                        $bubbleClass = 'bg-gray-200 text-gray-800 px-4 py-2 rounded-2xl';
                    }
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
                            {{ strtoupper(substr($message->user->first_name ?? 'U', 0, 1)) }}
                        </div>
                    @endif

                    <div class="{{ $bubbleClass }} text-sm md:text-md max-w-[60%] break-words p-0">
                        @if($isQuickReply)
                            <span class="bot-reply-label">🤖 Bot Reply</span>
                        @endif
                        {!! $message->message !!}
                    </div>

                    @if($message->user_id === auth()->id())
                        <div class="w-9 h-9 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-sm font-bold">
                            {{ strtoupper(substr(auth()->user()->first_name ?? 'U', 0, 1)) }}
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <div class="text-sm text-gray-500 text-center">
                No messages yet. Start the conversation!
            </div>
        @endif
    </div>

    <!-- Quick Replies -->
    @php
        use App\Models\QuickReply;
        $userRole = auth()->user()->role_id;

        if ($userRole == 3) {
            // Admin sees all quick replies
            $quickReplies = QuickReply::all();
        } else {
            // Support Staff or Member sees only their own quick replies
            $quickReplies = QuickReply::where('for_role_id', $userRole)->get();
        }
    @endphp

    <div class="flex gap-2 p-3 border-t border-gray-200 bg-white overflow-x-auto flex-shrink-0 scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
        <!-- Manage Button (Only for Admin) -->
@if(auth()->user()->role_id == 3)
    <button 
        onclick="window.location.href='{{ route('settings', ['section' => 'chat']) }}'"
        class="ml-auto bg-[#4C956C] text-white px-4 py-1 rounded-full text-sm md:text-md hover:bg-[#3d7e59] whitespace-nowrap">
        Manage
    </button>
@endif

        @forelse($quickReplies as $reply)
            <button 
                class="bg-gray-200 px-3 py-1 rounded-full text-sm md:text-md hover:bg-gray-300 whitespace-nowrap quick-reply-btn"
                data-question="{{ htmlspecialchars($reply->question, ENT_QUOTES, 'UTF-8') }}"
                data-answer="{{ htmlspecialchars($reply->answer, ENT_QUOTES, 'UTF-8') }}"
                onclick="sendQuickReply(this)">
                {{ $reply->question }}
            </button>
        @empty
            <span class="text-sm text-gray-400 italic w-10">No quick replies available.</span>
        @endforelse


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
