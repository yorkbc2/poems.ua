<template>
	<div class="follow-button-inline">
		<div v-if="modal == true" id="myModal" class="modal" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button @click="CloseModal()" type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Повідомлення</h4>
		      </div>
		      <div class="modal-body">
		        <p>Ви можете підписатись тільки після авторизації на сайті. <a href="/auth">Увійдіть або зареєструйтесь!</a> </p>
		      </div>
		      <div class="modal-footer">
		        <button @click="CloseModal()" type="button" class="btn btn-default" data-dismiss="modal">ОК</button>
		      </div>
		    </div>

		  </div>
		</div>
		<button class="follow-button" @click="ShowModal()">
			Стежити
		</button>
	</div>
</template>


<script>
	export default {
		data() {
			return {
				modal: false
			}
		},
		methods: {
			ShowModal() {
				this.modal = true;
			},
			CloseModal() {
				this.modal = false;
			}
		}
	}
</script>