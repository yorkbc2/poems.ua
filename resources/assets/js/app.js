
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.VueResource = require('vue-resource');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueResource)

Vue.component('admin-tabs-app', require('./components/AdminTabs.vue'));
Vue.component('admin-content-app', require('./components/AdminContent.vue'));
Vue.component('admin-add-category', require('./components/AddCategory.vue'));
Vue.component('follow-button', require('./components/FollowButton.vue'));
Vue.component('fake-follow-button', require('./components/dumb/FakeFollowButton.vue'));
Vue.component('star-button', require('./components/controllers/StarButton.vue'));
Vue.component('panel-default', require('./components/dumb/Panel.vue'));
Vue.component('profile-poems', require('./components/ProfilePoems.vue'));

const app = new Vue({
    el: '#app',

    methods: {
    	tabOnClick(event) {
    		alert("tab clicked")
    	},
    	followNow(ev, profileId, userId, _token) {
    		ev.target.id = "unfollow-now-button"

    		ev.target.innerHTML = `<span class="original">
    		Ви підписані</span>
										<span class="mask">
											Відписатись &times;
										</span>`

			var self=this

			ev.target.addEventListener("click", function () {
				self.unFollowNow()
			})
            ev.target.className = "changed-text"
            ev.target.setAttribute("data-text", "Відписатись")

			this.$http.post("/profile/follow", {
				profile: profileId,
				user: userId,
				_token: document.querySelector("#hidden_csrf_token").value
			}, {emulateJSON: true})
				.then(res => {
					console.log(res)
				}, (err) => console.error(err))

    	},
    	unFollowNow(ev, profileId, userId) {
            var self = this;
            var _token = document.querySelector("#hidden_token").value;

            ev.target.id = "follow-now-button";
            ev.target.innerHTML = "Стежити"

            ev.target.addEventListener("click", function () {
                self.followNow()
            })

            ev.target.className = ""

            ev.target.removeEventListener("mouseover", true)
            ev.target.removeEventListener("mouseout", true)


            this.$http.post("/profile/unfollow", {
                profile: profileId,
                user: userId,
                _token: _token
            }, {emulateJSON: true})
                .then(res => {
                    console.log(res)
                }, err => console.error(err)) 

    	},
    	setReview(ev) {
    		var area = ev.target.querySelector("textarea"),
    			token = ev.target.querySelector("input[name=_token]");

    		var content = area.value,
    			_token  = token.value,
    			id      = document.querySelector("#post_id_hidden").value;



    		this.$http.post("/poem/add/review", {
    			content: content,
    			_token: _token,
    			id: id
    		}, {
    			emulateJSON: true
    		}).then(res => {
    			if(document.querySelector("#no-reviews")) {
    				document.querySelector("#no-reviews").parentNode.removeChild(document.querySelector("#no-reviews"))
    			}

    			var newReview = document.createElement("div");

    			newReview.className="review";

    			newReview.innerHTML = `
					<div class="review-header">
						<h2>${res.body.author_name} @${res.body.author_login}</h2>
						<p>
							${res.body.content}
						</p>
					</div>
    			`;

    			document.querySelector("#reviews").insertBefore(newReview, document.querySelector("#reviews").firstChild)
    		}, err => console.error(err))
    	}
    },

    mounted() {


        var buttonsChangedText = document.querySelectorAll(".changed-text");


        buttonsChangedText.forEach(el => {

            var oldval = el.innerHTML;

            el.addEventListener("mouseover", function () {
                el.innerHTML = el.getAttribute("data-text")
            })
            el.addEventListener("mouseout", function () {
                el.innerHTML = oldval;
            })

        })

    }

});
