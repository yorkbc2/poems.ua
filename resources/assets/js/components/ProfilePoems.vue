<template>
	<div>
		<div class="profile-tabs">
			<button @click="changeTab($event, 'common')" class="profile-tab active">
				Мої поеми
			</button>
			<button @click="changeTab($event, 'stars')" class="profile-tab">
				Улюблені поеми
			</button>
			<button @click="changeTab($event, 'banned')" class="profile-tab" disabled>
				Заблокованні публікації
			</button>
			<button @click="changeTab($event, 'reports')" class="profile-tab" disabled>
				Скарги
			</button>
		</div>
		<div class="profile-poems">
			<div v-if="status == 'common'">
				<div v-for="poem in poemList" class="poem col-md-6">
					<div class="panel panel-default">
						<div class="panel-body">
						<span>
							Переглядів: {{poem.views}} | Зірок: {{poem.stars}}
						</span>
							<h1><a :href="'/poem/' + poem.id">{{poem.title}}</a></h1>
							<span>
								{{poem.date}}
							</span>
						</div>
					</div>
				</div>
			</div>
			<div v-else-if="status == 'stars'">
				<div v-if="spoemList.length > 0">
					<div v-for="poem in spoemList" class="poem col-md-6">
						<div class="panel panel-default">
							<div class="panel-body">
								<button class="tr-button close-button" @click="deleteFromStars($event, poem.id)">
									&times;
								</button>
								<span>
									Переглядів: {{poem.views}} | Зірок: {{poem.stars}}
								</span>
								<br>
								<span>
									Автор: <a :href="'/profile/' + poem.author_id">
										{{poem.author_name}}
									</a>
								</span>
								<h1>
									<a :href="'/poem/' + poem.id">{{poem.title}}</a>
								</h1>
								<span>
									{{poem.date}}
								</span>
							</div>
						</div>
					</div>
				</div>
				<div v-else style="text-align: center;">
					<h2>
						\_^_^_/
					</h2>
					<p>
						Сподобавшихся композицій не знайдено!
					</p>
				</div>
			</div>
		</div>
	</div>
</template>


<script>
	export default {
		name: "profilePoems",
		props: ["poems", "spoems", "user", "token"],
		data() {
			return {
				poemList: [],
				status: 'common',
				spoemList: []
			}
		},
		methods: {
			changeTab(ev, status) {
				document.querySelectorAll(".profile-tab").forEach((e) => {
					e.classList.remove('active')
				})
				ev.target.classList.add('active')
				this.status = status;
			},

			deleteFromStars (ev, id) {

				var self = this;

				this.$http.post("/poem/unstar", {
					user: this.user,
					poem: id,
					_token: this.token
				}, {emulateJSON: true}).then(res =>{
					console.log(res)

					// Code here

					self.spoemList = self.spoemList.filter((el) => {
						return el.id !== id;
					})


				}, err => console.error(err))
			}
		},
		mounted() {
			this.poemList = JSON.parse(this.poems)
			this.spoemList = JSON.parse(this.spoems);
		}
	}
</script>