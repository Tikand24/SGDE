Vue.http.options.root = '/root';
Vue.http.headers.common['X-CSRF-TOKEN'] = document.getElementById("token").getAttribute("value");