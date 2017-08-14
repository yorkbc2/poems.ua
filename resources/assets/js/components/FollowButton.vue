<template>
	<div class="follow-button-inline">
		<button v-if="isFollow == 'true' || isFollow == true" class="un follow-button" @click="unFollow()">
		Відписатися
		</button>
		<button v-else class="follow-button" @click="Follow()">
			Стежити
		</button>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				opt: {
					emulateJSON: true
				},
				isFollow: this.follow
			}
		},
		props: ['follow', 'profile', 'user', 'token'],
		methods: {
			unFollow() {

				this.isFollow = false;

				this.$http.post("/profile/unfollow", {
					profile: parseInt(this.profile),
					user: parseInt(this.user),
					_token: this.token
				}, this.opt).then(res => {
					document.querySelector("#followers-number").innerHTML = res.body;
				}, err => console.error(err))

			},
			Follow() {

				this.isFollow = true

				this.$http.post("/profile/follow", {
					profile: parseInt(this.profile),
					user: parseInt(this.user),
					_token: this.token
				}, this.opt).then(res => {
					document.querySelector("#followers-number").innerHTML = res.body;
				}, err => console.error(err))

			}
		}
	}
</script>