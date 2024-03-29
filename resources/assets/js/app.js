/**
 * First we will load all of this project's JavaScript dependencies which
 *
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('flash', require('./components/flash.vue'));
Vue.component('setupcourses', require('./components/setcourses.vue'));
Vue.component('settings', require('./components/settings.vue'));
Vue.component('subtask', require('./components/subtask.vue'));
Vue.component('create-subtask', require('./components/subtasks/CreateSubTask.vue'));
Vue.component('notification-button', require('./components/NotificationButton.vue'));
Vue.component('date-picker', require('vuejs-datepicker'));
Vue.component('subtask-editor', require('./components/subtaskeditor.vue'));
Vue.component('todo-list', require('./components/TodoList.vue'));

const app = new Vue({
    el: '#app'
});
