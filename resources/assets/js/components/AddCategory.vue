<template>
	<div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="alert alert-success" v-if="message.success">
					{{message.success}}
				</div>
				<div class="alert alert-danger" v-if="message.error">
					{{message.error}}
				</div>
				<form v-on:submit.prevent="addCategorySubmit($event)" class="form-field">
					<div class="form-group">
						<input v-model="cat.title" class="form-control" type="text" placeholder="Назва категорії" required>
					</div>

					<div class="form-group">
						<button class='btn btn-default'>
							Додати зараз!
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>


<script>

	export default {
		name: "AddCategory",
		props: ["_token"],
		data() {
			return {
				cat: {
					title: "",
					_token: ""
				},
				message: {
					error: "",
					success: ""
				}
			}
		},
		methods: {
			addCategorySubmit(ev) {
				this.$http.post("/admin/add/category",
				{
					title: this.cat.title,
					_token: this._token
				},
				{
					emulateJSON: true
				}).then(res => {

					console.log(res)
					if(res.body[0] === 0) {
						this.message.success = ""
						this.message.error = "Категорія '" + this.cat.title + "' вже існує."
					}
					else if (res.body[0] === 1) {
						this.message.success = "Категорія '" + this.cat.title + "' успішно додано!"
						this.message.error = ""
					}

				}, err => {document.body.innerHTML = err.body})
			}
		}
	}
	
</script>