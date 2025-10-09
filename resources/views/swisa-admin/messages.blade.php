@extends('layouts.app')

@section('content')
@include('layouts.loading-overlay')

<style>
/* Scrollbar transparency and style */
::-webkit-scrollbar {
  height: 10px;
  background: rgba(76, 149, 108, 0.5);
}

/* Smooth scroll behavior globally */
html, body, #chat-messages {
  scroll-behavior: smooth;
}

/* Smooth fade-in animation for chat panel and messages */
.fade-in {
  animation: fadeIn 0.4s ease-in-out forwards;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* Smooth slide-in when switching between chats */
.chat-slide-in {
  animation: slideIn 0.35s ease-in-out forwards;
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="p4">
  <div class="-m-3 sd:h-screen h-full flex bg-white rounded-2xl border border-gray-200">

    <!-- LEFT SIDEBAR -->
    <div class="w-full md:w-1/4 border-r border-gray-200 flex flex-col rounded-2xl">
      <!-- Header -->
      <div class="h-[70px] p-5 border-b border-gray-300 flex flex-col justify-center">
        <h2 class="font-semibold text-lg text-gray-800 pl-2">Chats</h2>
      </div>

      <!-- Search + Filter -->
      <div class="p-3 border-b border-gray-200 bg-gray-50 flex items-center gap-2">
        <div class="relative flex-1">
          <input 
            type="text" 
            id="chat-search" 
            placeholder="Search chats..." 
            class="w-full p-2 pl-9 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#4C956C] focus:outline-none text-sm" 
            onkeyup="filterChats()">
          <svg class="absolute left-2 top-2.5 w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1010.5 18.5a7.5 7.5 0 006.15-3.85z" />
          </svg>
        </div>

        <div class="relative">
          <select 
            id="chat-filter" 
            class="border border-gray-300 rounded-lg text-sm p-2 focus:ring-2 focus:ring-[#4C956C] focus:outline-none bg-white"
            onchange="filterChats()">
            <option value="all">All</option>
            <option value="support">Support Staff</option>
            <option value="user">User</option>
          </select>
        </div>
      </div>

      <!-- Chat User List -->
      <div id="chat-user-list" class="w-full flex-1 overflow-y-auto p-4 ">
        @php
          use App\Models\Chat;
          use App\Models\User;

          $currentUser = auth()->user();

          $chats = Chat::with(['messages' => function($q) {
              $q->latest()->limit(1);
          }, 'admin', 'supportStaff'])
          ->when($currentUser->role_id == 2, function($q) use ($currentUser) {
              $q->where('support_staff_id', $currentUser->id);
          })
          ->get()
          ->sortByDesc(function($chat) {
              return optional($chat->messages->first())->created_at ?? now()->subYears(10);
          })
          ->values();
        @endphp

        @if($chats->count())
          @foreach($chats as $chat)
            @php
              $otherUser = $chat->admin_id == auth()->id() ? $chat->supportStaff : $chat->admin;
              if (!$otherUser) continue;
              $latestMessage = $chat->messages->first();
              $messageText = $latestMessage ? $latestMessage->message : 'Click to chat';
              $isUnread = $latestMessage && !$latestMessage->is_read && $latestMessage->user_id != auth()->id();
              $roleLabel = $otherUser->role_id == 2 ? 'support' : 'user';
            @endphp
            <button 
              data-user-id="{{ $otherUser->id }}"
              data-role="{{ $roleLabel }}"
              class="chat-user block w-full text-left px-8 py-6 flex items-center gap-5 hover:bg-gray-100 transition relative rounded-xl {{ $loop->first ? 'border-t' : '' }}">
              <div class="w-10 h-10 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-sm font-bold ">
                {{ strtoupper(substr($otherUser->name, 0, 1)) }}
              </div>
              <div class="flex-1 overflow-hidden">
                <p class="text-sm font-medium truncate chat-user-name">{{ $otherUser->name }}</p>
                <p id="message-status-{{ $otherUser->id }}" class="text-xs truncate {{ $isUnread ? 'text-red-500 font-semibold' : 'text-gray-500' }}">
                  {{ $isUnread ? 'New message' : $messageText }}
                </p>
              </div>
            </button>
          @endforeach
        @else
          <div class="p-4 text-sm text-gray-500">No chats available.</div>
        @endif
      </div>
    </div>

    <!-- RIGHT CHAT PANEL -->
    <div id="chat-panel" class="flex-1 flex flex-col h-[850px] w-full bg-[#B2D6D3] bg-opacity-10 transition-all duration-300 ease-in-out">
      <div class="flex flex-col items-center justify-center h-full text-gray-400 text-center px-4 fade-in">
        <svg class="w-10 h-10 sm:w-14 sm:h-14 mb-3 text-[#4C956C]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h8m-8 4h5m-9 4h14a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <p class="text-sm sm:text-base md:text-lg font-medium">
          Select a chat to start the conversation.
        </p>
      </div>
    </div>
  </div>
</div>

{{-- ============================= --}}
{{-- JAVASCRIPT SECTION --}}
{{-- ============================= --}}
<script>
const CURRENT_USER_ID = {!! json_encode(auth()->id()) !!};
let CHAT_ID = null;
let ACTIVE_USER_ID = null;
let lastMessageId = 0;
let pollInterval = null;

// CLICK CHAT
document.querySelectorAll('.chat-user').forEach(btn => {
  btn.addEventListener('click', async () => {
    const userId = parseInt(btn.getAttribute('data-user-id'));
    ACTIVE_USER_ID = userId;

    document.querySelectorAll('.chat-user').forEach(u => u.classList.remove('bg-[#E8F3EC]', 'font-semibold'));
    btn.classList.add('bg-[#E8F3EC]', 'font-semibold');

    try {
      const res = await axios.get(`/chat/${userId}/load`);
      const panel = document.getElementById('chat-panel');
      panel.classList.remove('chat-slide-in');
      panel.innerHTML = res.data.html;
      void panel.offsetWidth; // reflow trick
      panel.classList.add('chat-slide-in');
      
      CHAT_ID = res.data.chat_id;
      lastMessageId = res.data.last_message_id || 0;

      await axios.post(`/chat/${CHAT_ID}/mark-as-read`);
      const statusText = document.getElementById(`message-status-${userId}`);
      if (statusText) {
        statusText.textContent = "Click to chat";
        statusText.classList.remove('text-red-500', 'font-semibold');
        statusText.classList.add('text-gray-500');
      }

      smoothScrollToBottom();
      startPolling();
      setupChatEvents();
    } catch (err) {
      console.error('Chat load failed:', err);
    }
  });
});

// Smooth scroll behavior for messages
function smoothScrollToBottom() {
  const container = document.getElementById('chat-messages');
  if (!container) return;
  container.scrollTo({
    top: container.scrollHeight,
    behavior: 'smooth'
  });
}

// Append message with fade animation
function appendMessage(message) {
  const container = document.getElementById('chat-messages');
  if (!container) return;

  const msgTime = new Date(message.created_at);
  const timeLabel = msgTime.toLocaleString('en-US', { month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true });

  const wrapper = document.createElement('div');
  wrapper.classList.add("flex", "items-end", "gap-2", "mt-1", "fade-in");
  if (message.user_id === CURRENT_USER_ID) wrapper.classList.add("justify-end");

  const bubbleClass = message.user_id === CURRENT_USER_ID
    ? 'bg-[#4C956C] text-white px-4 py-2 rounded-2xl'
    : 'bg-gray-200 text-gray-800 px-4 py-2 rounded-2xl';

  wrapper.innerHTML = `
    ${message.user_id !== CURRENT_USER_ID ? `<div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-xs font-bold">${(message.user?.name?.charAt(0).toUpperCase() ?? 'U')}</div>` : ''}
    <div class="${bubbleClass} text-sm md:text-md max-w-[80%] break-words">${message.message}</div>
    ${message.user_id === CURRENT_USER_ID ? `<div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-xs font-bold">${(message.user?.name?.charAt(0).toUpperCase() ?? 'U')}</div>` : ''}
  `;
  container.appendChild(wrapper);
  smoothScrollToBottom();
}

// Sending message logic
function sendMessage() {
  if (!CHAT_ID) return alert('Select a chat first.');
  const input = document.getElementById('chat-input');
  const msg = input.value.trim();
  if (!msg) return;

  const btn = document.getElementById('send-btn');
  btn.disabled = true;

  axios.post(`/chat/${CHAT_ID}/message`, { message: msg })
    .then(res => {
      input.value = '';
      appendMessage(res.data);
      lastMessageId = res.data.id;
      moveChatToTop(ACTIVE_USER_ID);
    })
    .finally(() => btn.disabled = false);
}

function setupChatEvents() {
  const input = document.getElementById('chat-input');
  const btn = document.getElementById('send-btn');
  if (!input || !btn) return;

  btn.addEventListener('click', sendMessage);
  input.addEventListener('keydown', e => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  });
}

async function pollMessages() {
  if (!CHAT_ID) return;
  try {
    const res = await axios.get(`/chat/${CHAT_ID}/poll?last_id=${lastMessageId}`);
    res.data.messages.forEach(msg => {
      appendMessage(msg);
      lastMessageId = msg.id;
      moveChatToTop(msg.user_id === CURRENT_USER_ID ? ACTIVE_USER_ID : msg.user_id);
    });
  } catch (err) {
    console.error('Polling failed:', err);
  }
}

async function updateUnreadIndicators() {
  try {
    const res = await axios.get('/chat/unread-check');
    Object.entries(res.data).forEach(([id, hasUnread]) => {
      const statusText = document.getElementById(`message-status-${id}`);
      const chatButton = document.querySelector(`.chat-user[data-user-id="${id}"]`);
      if (!statusText || !chatButton) return;
      if (parseInt(id) === ACTIVE_USER_ID) return;

      if (hasUnread) {
        statusText.textContent = "New message";
        statusText.classList.add('text-red-500', 'font-semibold');
        statusText.classList.remove('text-gray-500');
        moveChatToTop(id);
      } else {
        statusText.textContent = "Click to chat";
        statusText.classList.remove('text-red-500', 'font-semibold');
        statusText.classList.add('text-gray-500');
      }
    });
  } catch (err) {
    console.error('Unread update failed:', err);
  }
}

function startPolling() {
  if (pollInterval) clearInterval(pollInterval);
  pollInterval = setInterval(pollMessages, 1000);
}

updateUnreadIndicators();
setInterval(updateUnreadIndicators, 1000);

function moveChatToTop(userId) {
  const chatBtn = document.querySelector(`.chat-user[data-user-id="${userId}"]`);
  if (chatBtn && chatBtn.parentNode) {
    chatBtn.parentNode.prepend(chatBtn);
  }
}

function filterChats() {
  const searchInput = document.getElementById('chat-search').value.toLowerCase();
  const filterValue = document.getElementById('chat-filter').value;
  const chatUsers = document.querySelectorAll('#chat-user-list .chat-user');

  chatUsers.forEach(user => {
    const name = user.querySelector('.chat-user-name').textContent.toLowerCase();
    const userRole = user.getAttribute('data-role') || '';
    const matchesSearch = name.includes(searchInput);
    const matchesFilter = 
      filterValue === 'all' ||
      (filterValue === 'support' && userRole === 'support') ||
      (filterValue === 'user' && userRole === 'user');

    user.style.display = matchesSearch && matchesFilter ? 'flex' : 'none';
  });
}
</script>
@endsection
