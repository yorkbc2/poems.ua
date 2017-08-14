<template>

	<div class="panel panel-default">
		<div class="panel-heading">
			{{this.heading}}
		</div>
		<div class="panel-body">
			<slot>

			</slot>
		</div>
	</div>

</template>

<script>
	export default {
		props: ['heading']
	}
</script>