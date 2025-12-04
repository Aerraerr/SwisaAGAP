@extends('layouts.app')

@section('content')

<style>
/* Scrollbar transparency and style */
::-webkit-scrollbar {
  height: 10px;
  background: rgba(76, 149, 108, 0.5);
}
html, body, #chat-messages {
  scroll-behavior: smooth;
}
.fade-in { animation: fadeIn 0.4s ease-in-out forwards; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(10px);} to { opacity: 1; transform: translateY(0);} }
.chat-slide-in { animation: slideIn 0.35s ease-in-out forwards; }
@keyframes slideIn { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: translateY(0);} }
</style>

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="p-3">
  <div class="-mt-7 sd:h-screen h-full flex bg-white rounded-2xl border border-gray-200 relative">

    <!-- LEFT SIDEBAR -->
    <div class="w-full md:w-1/4 border-r border-gray-200 flex flex-col rounded-2xl">
      <div class="h-[70px] p-5 border-b border-gray-300 flex flex-col justify-center">
        <h2 class="font-semibold text-lg text-gray-800 pl-2">
          {{ Auth::user()->role_id == 1 ? 'All Users' : 'Chats' }}
        </h2>
      </div>

      <!-- Search + Filter -->
      <div class="p-3 border-b border-gray-200 bg-gray-50 flex items-center gap-2">
        <div class="relative flex-1">
          <input 
            type="text" 
            id="chat-search" 
            placeholder="Search..." 
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
<div id="chat-user-list" class="w-full flex-1 overflow-y-auto p-4 max-h-[calc(100vh-120px)]">
    @php
        use App\Models\Chat;
        use App\Models\User;
        use Illuminate\Support\Carbon;

        $currentUser = auth()->user();

        if ($currentUser->role_id == 3) {
            // 👑 Admin: show all users sorted by latest message
            $users = User::where('id', '!=', $currentUser->id)->get();

            $users = $users->map(function ($user) use ($currentUser) {
                $chat = Chat::where(function ($q) use ($currentUser, $user) {
                        $q->where('admin_id', $currentUser->id)
                          ->where('support_staff_id', $user->id);
                    })
                    ->orWhere(function ($q) use ($currentUser, $user) {
                        $q->where('admin_id', $user->id)
                          ->where('support_staff_id', $currentUser->id);
                    })
                    ->first();

                if ($chat) {
                    $latestMessage = $chat->messages()->latest()->first();
                    $user->latest_message_at = $latestMessage ? Carbon::parse($latestMessage->created_at) : null;
                    $user->latest_message = $latestMessage?->message;
                    $user->is_unread = $latestMessage && !$latestMessage->is_read && $latestMessage->user_id != auth()->id();
                } else {
                    $user->latest_message_at = null;
                    $user->latest_message = null;
                    $user->is_unread = false;
                }

                return $user;
            });

            $chats = $users->sortByDesc(function ($user) {
                return $user->latest_message_at?->timestamp ?? -INF;
            })->values();
        } else {
            // 🧑‍💼 Support staff or 👤 Member
            $chats = Chat::with([
                'messages' => fn($q) => $q->latest()->limit(1),
                'admin',
                'supportStaff'
            ])
            ->when($currentUser->role_id == 2, fn($q) => $q->where('support_staff_id', $currentUser->id))
            ->when($currentUser->role_id == 1, fn($q) => $q->where('member_id', $currentUser->id))
            ->get()
            ->sortByDesc(fn($chat) => optional($chat->messages->first())->created_at ?? now()->subYears(10))
            ->values();
        }
    @endphp

    @if(($chats ?? collect())->count())
        @foreach($chats as $chat)
            @php
                if ($currentUser->role_id == 3) {
                    // Admin’s view
                    $otherUser = $chat;
                    $messageText = $otherUser->latest_message ?: 'Click to chat';
                    $isUnread = $otherUser->is_unread ?? false;
                    $roleLabel = $otherUser->role_id == 2 ? 'support' : 'member';
                } else {
                    // Member or Support Staff view
                    $otherUser = $currentUser->role_id == 2 ? $chat->admin : $chat->supportStaff;
                    if (!$otherUser) continue;

                    $latestMessage = $chat->messages->first();
                    $messageText = $latestMessage?->message ?: 'Click to chat';
                    $isUnread = $latestMessage && !$latestMessage->is_read && $latestMessage->user_id != auth()->id();
                    $roleLabel = $otherUser->role_id == 2 ? 'support' : ($otherUser->role_id == 3 ? 'admin' : 'member');
                }

                $otherName = trim(($otherUser->first_name ?? '') . ' ' . ($otherUser->last_name ?? ''));
                $displayId = $otherUser->id;
            @endphp

            <button 
                data-user-id="{{ $displayId }}"
                data-role="{{ $roleLabel }}"
                class="chat-user block w-full text-left px-8 py-6 flex items-center gap-5 hover:bg-gray-100 transition relative rounded-xl {{ $loop->first ? 'border-t' : '' }}">
                <div class="w-10 h-10 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-sm font-bold">
                    {{ strtoupper(substr($otherUser->first_name ?? 'U', 0, 1)) }}
                </div>
                <div class="flex-1 overflow-hidden">
                    <p class="text-sm font-medium truncate chat-user-name">{{ $otherName ?: 'Unknown User' }}</p>
                    <p id="message-status-{{ $displayId }}" class="text-xs truncate {{ $isUnread ? 'text-red-500 font-semibold' : 'text-gray-500' }}">
                        {{ $isUnread ? 'New message' : $messageText }}
                    </p>
                </div>
            </button>
        @endforeach
    @else
        <div class="p-4 text-sm text-gray-500 text-center">No chats available.</div>
    @endif

    {{-- 👇 Additional message for support staff --}}
    @if($currentUser->role_id == 2)
        <div class="text-center mt-6 text-gray-600 text-sm italic">
            You can only chat with the admin.
        </div>
    @endif
</div>



    </div>

    <!-- RIGHT CHAT PANEL -->
    <div id="chat-panel" class="flex-1 flex flex-col h-[850px] w-[500px] bg-[#B2D6D3] bg-opacity-10 transition-all duration-300 ease-in-out">
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

<script>
const CURRENT_USER_ID = {!! json_encode(auth()->id()) !!};
let CHAT_ID = null;
let ACTIVE_USER_ID = null;
let lastMessageId = 0;
let pollingInterval = null;

// --------------------
// CHAT SELECTION
// --------------------
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
      void panel.offsetWidth;
      panel.classList.add('chat-slide-in');

      CHAT_ID = res.data.chat_id;
      lastMessageId = res.data.last_message_id || 0;

      await axios.post(`/chat/${CHAT_ID}/mark-as-read`);
      updateChatStatus(userId, false);

      setupChatEvents();
      smoothScrollToBottom();

      // reset polling
      if (pollingInterval) clearInterval(pollingInterval);
      pollingInterval = setInterval(pollMessages, 2000); // faster refresh
    } catch (err) {
      console.error('Chat load failed:', err);
    }
  });
});

// --------------------
// POLLING
// --------------------
async function pollMessages() {
  if (!CHAT_ID) return;

  try {
    const res = await axios.get(`/chat/${CHAT_ID}/poll`, { params: { last_id: lastMessageId } });
    const newMessages = res.data.messages || [];
    if (newMessages.length > 0) {
      newMessages.forEach(msg => appendMessage(msg));
      lastMessageId = newMessages[newMessages.length - 1].id;
      smoothScrollToBottom();
      await axios.post(`/chat/${CHAT_ID}/mark-as-read`);
    }
  } catch (err) {
    console.error('Polling failed:', err);
  }
}

// --------------------
// SCROLL
// --------------------
function smoothScrollToBottom() {
  const container = document.getElementById('chat-messages');
  if (container) container.scrollTo({ top: container.scrollHeight, behavior: 'smooth' });
}

// --------------------
// APPEND MESSAGE
// --------------------
function appendMessage(message) {
  const container = document.getElementById('chat-messages');
  if (!container) return;

  if (document.getElementById(`msg-${message.id}`)) return; // prevent duplicate

  const wrapper = document.createElement('div');
  wrapper.id = `msg-${message.id}`;
  wrapper.classList.add("flex", "items-end", "gap-2", "mt-1", "fade-in");
  if (message.user_id === CURRENT_USER_ID) wrapper.classList.add("justify-end");

  let bubbleClass = 'bg-gray-200 text-gray-800 px-4 py-2 rounded-2xl';
  if (message.is_auto_reply) {
    bubbleClass = 'bg-transparent border border-[#4C956C] text-[#2C6E49] px-4 py-2 rounded-2xl italic';
  } else if (message.user_id === CURRENT_USER_ID) {
    bubbleClass = 'bg-[#4C956C] text-white px-4 py-2 rounded-2xl';
  }

  const senderInitial = message.user?.first_name 
    ? message.user.first_name.charAt(0).toUpperCase() 
    : 'U';

  wrapper.innerHTML = `
    ${message.user_id !== CURRENT_USER_ID ? `<div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-xs font-bold">${senderInitial}</div>` : ''}
    <div class="${bubbleClass} text-sm md:text-md max-w-[50%] break-words">${message.message}</div>
    ${message.user_id === CURRENT_USER_ID ? `<div class="w-8 h-8 rounded-full bg-[#2C6E49] flex items-center justify-center text-white text-xs font-bold">${senderInitial}</div>` : ''}
  `;
  container.appendChild(wrapper);
}

// --------------------
// SEND MESSAGE
// --------------------
async function sendMessage() {
  if (!CHAT_ID) return alert('Select a chat first.');
  const input = document.getElementById('chat-input');
  const msg = input.value.trim();
  if (!msg) return;
  const btn = document.getElementById('send-btn');
  btn.disabled = true;

  try {
    const res = await axios.post(`/chat/${CHAT_ID}/message`, { message: msg });
    const sentMsg = res.data;

    appendMessage(sentMsg);
    input.value = '';
    lastMessageId = sentMsg.id;

    moveChatToTop(ACTIVE_USER_ID);

    // 🔄 Immediately check for new incoming replies
    setTimeout(pollMessages, 500);

  } catch (err) {
    console.error('Send message failed:', err);
  } finally {
    btn.disabled = false;
  }
}

// --------------------
// QUICK REPLY
// --------------------
async function sendQuickReply(button) {
  if (!CHAT_ID) return alert('Select a chat first.');
  const question = button.getAttribute('data-question');
  const answer = button.getAttribute('data-answer');

  try {
    // Send user's quick message (normal chat bubble)
    const resUser = await axios.post(`/chat/${CHAT_ID}/message`, { message: question });
    appendMessage(resUser.data);

    // Auto reply with styled design (distinct bubble)
    const styledReply = `
      <div style="
        background: #e9f7ef;
        border-left: 4px solid #2C6E49;
        padding: 10px 10px;
        border-radius: 10px;
        margin-top: 6px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        display: inline-block;
        max-width: 100%;
        color: #2C6E49;
        font-style: italic;
        font-size: 0.9rem;
      ">
        <strong style="color:#1e4620; font-style: normal;">Auto Reply:</strong> ${answer}
      </div>
    `;

    const resBot = await axios.post(`/chat/${CHAT_ID}/message`, {
      message: styledReply,
      is_auto_reply: true
    });

    appendMessage(resBot.data);

    lastMessageId = resBot.data.id;
    setTimeout(pollMessages, 500); // sync again after quick reply
  } catch (err) {
    console.error('Quick reply failed:', err);
  }
}


// --------------------
// EVENT SETUP
// --------------------
function setupChatEvents() {
  const input = document.getElementById('chat-input');
  const btn = document.getElementById('send-btn');
  if (!input || !btn) return;
  btn.onclick = sendMessage;
  input.onkeydown = e => {
    if (e.key === 'Enter' && !e.shiftKey) {
      e.preventDefault();
      sendMessage();
    }
  };
}

// --------------------
// UNREAD HANDLING
// --------------------
async function updateUnreadIndicators() {
  try {
    const res = await axios.get('/chat/unread-check');
    Object.entries(res.data).forEach(([id, hasUnread]) => updateChatStatus(id, hasUnread));
  } catch (err) {
    console.error('Unread update failed:', err);
  }
}

function updateChatStatus(id, hasUnread) {
  const statusText = document.getElementById(`message-status-${id}`);
  if (!statusText) return;
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
}

function moveChatToTop(userId) {
  const chatBtn = document.querySelector(`.chat-user[data-user-id="${userId}"]`);
  if (chatBtn && chatBtn.parentNode) chatBtn.parentNode.prepend(chatBtn);
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
      (filterValue === 'user' && (userRole === 'member' || userRole === 'admin')); // ✅ Fix here

    user.style.display = matchesSearch && matchesFilter ? 'flex' : 'none';
  });
}


// --------------------
// INITIALIZE
// --------------------
updateUnreadIndicators();
setInterval(updateUnreadIndicators, 3000);
</script>


@endsection
