<template>
	<div id="blocks">
		<article id="welcome">
			<h1>
				Welcome Administrator!
			</h1>
		</article>
		<article id="add">
			<h1>
				Add member
			</h1>
		</article>
		<article id="new_admin">
			<h1>
				Add admin
			</h1>
		</article>
		<article id="add_category">
			<h1>
				Додати категорію до списку категорій
			</h1>
			<admin-add-category :_token="_token"></admin-add-category>
		</article>
	</div>
</template>

<script>
	export default {
		props: ["_token"],
		mounted() {
			document.querySelectorAll("#blocks article").forEach(el => {
				el.style.display = "none";
			})	
		}
	}	
</script>