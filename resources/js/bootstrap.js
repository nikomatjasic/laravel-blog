import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

window.closeNotification = function (e) {
    e.target.parentNode.classList.add("disabled");
}

window.stringToHTMLElement = function (html) {
    let template = document.createElement('template');
    html = html.trim();
    template.innerHTML = html;
    return template.content.firstChild;
}

const notificationBox = window.stringToHTMLElement(`
<div class="n-box flex flex-col disabled" data-box="0">
    <div class="close"></div>
    <div class="n-box--header">
        <span><!-- message --></span>
    </div>
    <div class="n-box--content flex">
        <div class="n-box--image">
            <img src="/images/lary-avatar.svg" alt="Lary little robot" title="Lary the man"/>
        </div>
        <div class="n-box--text">
            <h4><!-- post title --></h4>
            <p><!-- post content --></p>
            <a href="<!-- link -->" class="link">Read more</a>
        </div>
    </div>
</div>`);

const notificationsContainer = document.querySelector('#notifications_container');

window.Laravel.userFollowing.forEach(element => {
    let channel = window.Echo.private("notify.user." + element.id + ".followers");
    // todo: test the order of fading notifications.
    channel.listen(".post.created", function(data) {
        console.log(data);
        let newNotification = notificationBox.cloneNode(true);
        let index = parseInt(notificationBox.getAttribute("data-box"));
        newNotification.setAttribute("data-box", (index + 1));

        if (newNotification.classList.contains("disabled")) {
            newNotification.classList.remove("disabled");
        }
        newNotification.querySelector('.n-box--header > span').innerHTML = data.user.name + " has created new post!";
        newNotification.querySelector('.n-box--content > .n-box--text > h4').innerHTML = data.post.title;
        newNotification.querySelector('.n-box--content > .n-box--text > p').innerHTML = data.post.excerpt;
        newNotification.querySelector('.close').setAttribute("onclick", "window.closeNotification(event)");
        setTimeout(() => {
            notificationsContainer.append(newNotification);
        }, 1000 * index);
        setTimeout(() => {
            newNotification.classList.add("disabled");
        }, 5000 * index);
    });
});

