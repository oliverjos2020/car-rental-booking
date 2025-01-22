window._ = require('lodash');
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '62fa54aa1df62c15f35a', // Use MIX_ prefix
    cluster: 'eu',
    forceTLS: true
});
