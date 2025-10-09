@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')

{{-- CSRF token for JS --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="h-screen flex flex-col md:flex-row bg-white -m-5">
    <!-- MOBILE HEADER -->
    <div class="md:hidden flex items-center justify-between p-4 border-b border-gray-200 bg-[#2C6E49] text-white">
        <h1 class="font-semibold text-lg">Chats</h1>
        <button id="mobile-sidebar-toggle" class="focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    <!-- LEFT SIDEBAR -->
    <div id="sidebar"
         class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 transform -translate-x-full transition-transform duration-300 md:relative md:translate-x-0 md:w-1/4 md:flex md:flex-col">
        <div class="p-5 border-b border-gray-200 flex items-center justify-between">
            <h2 class="font-semibold text-lg text-gray-800">Chats</h2>
            <button id="close-sidebar" class="md:hidden text-gray-500 hover:text-gray-800">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto">
            @if(auth()->check())
                @php
                    $user = auth()->user();
                    if ($user->role_id == 2) {
                        $chatUsers = \App\Models\User::where('role_id', 3)->get();
                    } elseif ($user->role_id == 3) {
                        $chatUsers = \App\Models\User::where('role_id', 2)->get();
                    } else {
                        $chatUsers = collect();
                    }
                @endphp

                @if($chatUsers->count())
                    @foreach($chatUsers as $chatUser)
                        <a href="{{ route('chat.show', $chatUser->id) }}"
                           class="block px-5 py-3 flex items-center gap-3 hover:bg-gray-100 transition sidebar-chat-link">
                            <div class="w-10 h-10 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-sm font-bold">
                                {{ strtoupper(substr($chatUser->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 overflow-hidden">
                                <p class="text-sm font-medium truncate flex items-center justify-between">
                                    {{ $chatUser->name }}
                                    <span id="badge-{{ $chatUser->id }}"
                                          class="ml-2 bg-red-500 text-white text-xs rounded-full px-2 hidden">0</span>
                                </p>
                                <p class="text-xs text-gray-500 truncate">Click to chat</p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="p-4 text-sm text-gray-500">No users available to chat.</div>
                @endif
            @endif
        </div>
    </div>

    <!-- RIGHT CHAT PANEL -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <div class="p-4 border-b border-gray-200 flex items-center gap-3 bg-[#F9FAFB]">
            @php
                $selected = $chat ?? null;
                $selectedName = $selected ? ($selected->admin->name ?? $selected->supportStaff->name ?? 'Chat '.$selected->id) : 'Select a chat';
            @endphp

            <div class="w-10 h-10 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-sm font-bold">
                {{ strtoupper(substr($selectedName, 0, 1)) }}
            </div>
            <div class="min-w-0">
                <p class="font-semibold text-gray-800 truncate">{{ $selectedName }}</p>
                <p class="text-xs text-gray-500">{{ $selected ? 'Online' : '' }}</p>
            </div>
        </div>

        <!-- Messages -->
        <div id="chat-messages" class="flex-1 p-3 md:p-4 overflow-y-auto space-y-3 bg-[#F8FDF9]">
            @if(isset($messages) && $messages->count())
                @foreach($messages as $message)
                    <div class="flex items-end gap-2 {{ $message->user_id === auth()->id() ? 'justify-end' : '' }}">
                        @if($message->user_id !== auth()->id())
                            <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr($message->user->name ?? 'U', 0, 1)) }}
                            </div>
                        @endif

                        <div class="{{ $message->user_id === auth()->id() ? 'bg-[#4C956C] text-white' : 'bg-gray-200 text-gray-800' }} rounded-2xl px-4 py-2 text-sm max-w-[80%] md:max-w-[70%] break-words">
                            {{ $message->message }}
                        </div>

                        @if($message->user_id === auth()->id())
                            <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-xs font-bold">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="text-sm text-gray-500 text-center">No messages yet. Start the conversation!</div>
            @endif
        </div>

        <!-- Quick Replies -->
        <div class="flex gap-2 mt-2 p-3 border-t border-gray-200 bg-white overflow-x-auto">
            @if(isset($quickReplies) && $quickReplies->count())
                @foreach($quickReplies as $reply)
                    <button 
                        class="bg-gray-200 px-3 py-1 rounded-full text-sm hover:bg-gray-300 whitespace-nowrap quick-reply-btn"
                        data-answer="{{ htmlspecialchars($reply->answer, ENT_QUOTES, 'UTF-8') }}"
                        data-chat-id="{{ $chat->id ?? '' }}"
                        onclick="sendQuickReply(this)">
                        {{ $reply->question }}
                    </button>
                @endforeach
            @endif
        </div>

        <!-- Input -->
        <div class="border-t border-gray-200 p-3 flex items-center gap-2 bg-white">
            <input id="chat-input" type="text" placeholder="Type a message..."
                class="flex-1 p-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-[#4C956C] text-sm">
            <button id="send-btn" class="bg-[#4C956C] hover:bg-[#2C6E49] text-white px-4 py-2 rounded-full flex items-center justify-center">
                <i class="material-icons text-white text-lg">send</i>
            </button>
        </div>
    </div>
</div>

<script>
    const CHAT_ID = {!! json_encode($chat->id ?? null) !!};
    const CURRENT_USER_ID = {!! json_encode(auth()->id()) !!};
    let lastMessageId = {{ isset($messages) && $messages->count() ? $messages->last()->id : 0 }};

    function escapeHtml(unsafe) {
        if (!unsafe) return '';
        return String(unsafe)
            .replaceAll("&", "&amp;")
            .replaceAll("<", "&lt;")
            .replaceAll(">", "&gt;")
            .replaceAll('"', "&quot;")
            .replaceAll("'", "&#039;");
    }

    function appendMessage(message) {
        let container = document.getElementById('chat-messages');
        if (!container) return;

        let wrapper = document.createElement('div');
        wrapper.classList.add("flex", "items-end", "gap-2");
        if (message.user_id === CURRENT_USER_ID) wrapper.classList.add("justify-end");

        if (message.user_id === CURRENT_USER_ID) {
            wrapper.innerHTML = `
                <div class="bg-[#4C956C] text-white rounded-2xl px-4 py-2 text-sm max-w-[80%] md:max-w-[70%] break-words">
                    ${escapeHtml(message.message)}
                </div>
                <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-xs font-bold">
                    ${escapeHtml((message.user && message.user.name) ? message.user.name.charAt(0).toUpperCase() : 'U')}
                </div>
            `;
        } else {
            wrapper.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-xs font-bold">
                    ${escapeHtml((message.user && message.user.name) ? message.user.name.charAt(0).toUpperCase() : 'U')}
                </div>
                <div class="bg-gray-200 text-gray-800 rounded-2xl px-4 py-2 text-sm max-w-[80%] md:max-w-[70%] break-words">
                    ${escapeHtml(message.message)}
                </div>
            `;
        }

        container.appendChild(wrapper);
        container.scrollTop = container.scrollHeight;
    }

    function sendMessage() {
        if (!CHAT_ID) return alert('Please select a chat first.');
        let input = document.getElementById('chat-input');
        let message = input.value.trim();
        if (!message) return;

        const sendBtn = document.getElementById('send-btn');
        sendBtn.disabled = true;

        axios.post(`/chat/${CHAT_ID}/message`, { message })
            .then(res => {
                input.value = '';
                appendMessage(res.data);
                lastMessageId = res.data.id;
            })
            .finally(() => {
                sendBtn.disabled = false;
            });
    }

    function sendQuickReply(el) {
        if (!CHAT_ID) return alert('Please open a chat first.');
        const answer = el.getAttribute('data-answer');
        if (!answer) return;

        axios.post(`/chat/${CHAT_ID}/message`, { message: answer })
            .then(res => {
                appendMessage(res.data);
                lastMessageId = res.data.id;
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-btn');

        sendBtn.addEventListener('click', sendMessage);
        input.addEventListener('keydown', e => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        const container = document.getElementById('chat-messages');
        if (container) container.scrollTop = container.scrollHeight;

        // Mobile sidebar toggle
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('mobile-sidebar-toggle');
        const closeBtn = document.getElementById('close-sidebar');
        toggleBtn?.addEventListener('click', () => {
            sidebar.classList.remove('-translate-x-full');
        });
        closeBtn?.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
        });

        // Auto close sidebar after clicking chat link
        document.querySelectorAll('.sidebar-chat-link').forEach(link => {
            link.addEventListener('click', () => {
                sidebar.classList.add('-translate-x-full');
            });
        });

        if (CHAT_ID) {
            window.Echo.private(`chat.${CHAT_ID}`)
                .listen('.MessageSent', (e) => {
                    if (e.user_id !== CURRENT_USER_ID) appendMessage(e);
                });
        }
    });

    function pollMessages() {
        if (!CHAT_ID) return;
        axios.get(`/chat/${CHAT_ID}/poll?last_id=${lastMessageId}`)
            .then(res => {
                res.data.messages.forEach(msg => {
                    appendMessage(msg);
                    lastMessageId = msg.id;
                });
            })
            .catch(err => console.error('Polling failed:', err));
    }
    setInterval(pollMessages, 2000);
</script>
@endsection
