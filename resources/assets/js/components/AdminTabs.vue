<template>
	<div>
		<ul class="admin-tabs">
			<li>
				<button id="welcome-button" data-to="#welcome" @click="changeContent($event)" class="btn btn-block btn-default">
					Welcome
				</button>
			</li>
			<li>
				<button data-to="#add" @click="changeContent($event)" class="btn btn-block btn-default">
					Add +
				</button>
			</li>
			<li>
				<button data-to="#new_admin" @click="changeContent($event)" class="btn btn-block btn-default">
					New administrator
				</button>
			</li>
			<li>
				<button data-to="#add_category" @click="changeContent($event)" class="btn btn-block btn-default">
					Додати категорію
				</button>
			</li>
			<li>
				<a class="btn btn-block btn-default" href="/admin/logout">
					Logout
				</a>
			</li>
		</ul>
	</div>
</template>


<script>
	export default {
		name: "AdminTabs",
		methods: {
			changeContent(event) {
				this.hideAllBlocks();

				var block = document.querySelector(event.target.getAttribute("data-to"));


					document.querySelectorAll("ul.admin-tabs li button").forEach(el => {
										el.classList.remove('active-button')
									})


				event.target.classList.add("active-button")
				

				block.style.display = "block"
			},

			hideAllBlocks() {
				document.querySelectorAll("#blocks article").forEach(el => {
					el.style.display = "none"
				})
			}
		},

		mounted() {
			window.onload = function (e) {
				document.querySelector("#welcome-button").click()
			}
		}
	}
</script>


<style scoped>
	ul {
		margin: 0;
		padding: 0;
	}

	ul li {
		list-style: none;
		display: block;
	}

	.active-button {
		background-color: #f5f4f4;
	}
</style>