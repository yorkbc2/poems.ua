<template>
	<div style="display: inline-block;">
		<button v-if="star == 'true' || star == true" class="star active-star" @click="unStarPoem()">
			<i class="fa fa-star"></i>
		</button>
		<button v-else @click="starPoem()" class="star">
			<i class="fa fa-star"></i>
		</button>
	</div>
</template>

<script>
	export default {
		props: ["user", "poem", "stared", "token"],

		data() {

			return {
				star: this.stared
			}

		},

		methods: {
			unStarPoem() {
				this.sendStarPost("unstar", false)
			},
			starPoem() {
				this.sendStarPost("star", true)
			},

			sendStarPost(linkEnd, stared) {
				this.$http.post("/poem/" + linkEnd, {
					user: this.user,
					poem: this.poem,
					_token: this.token
				}, {emulateJSON: true}).then(res =>{
					this.star = stared
				}, err => console.error(err))

			}
		}
	}
</script>