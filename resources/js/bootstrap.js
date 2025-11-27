// resources/js/bootstrap.js
import axios from 'axios';
import Pusher from 'pusher-js';
import Echo from 'laravel-echo';

window.axios = axios;

// set csrf header for axios
const tokenEl = document.head.querySelector('meta[name="csrf-token"]');
if (tokenEl) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = tokenEl.content;
}
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// expose Pusher (pusher-js)
window.Pusher = Pusher;

// Enable pusher debug in console during development only
if (import.meta.env && import.meta.env.DEV) {
    Pusher.logToConsole = true;
}

// init Echo
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY || process.env.MIX_PUSHER_APP_KEY || '',
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER || process.env.MIX_PUSHER_APP_CLUSTER || '',
    forceTLS: true,
    encrypted: true,
    // optional: disable stats for console spam
    // enabledTransports: ['ws', 'wss'],
    auth: {
        headers: {
            'X-CSRF-TOKEN': tokenEl ? tokenEl.content : ''
        }
    }
});
