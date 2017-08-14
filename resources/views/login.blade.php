@extends("app")

@section("content")
			<div class="panel panel-default" style="margin-top: 30px;">
				<div class="panel-body">
					@if (isset($error))

					<div class="alert alert-danger">
						{{$error_message}}
					</div>
	
					@endif
					<form method="post" action="/admin/login" class="form-field">
						{{csrf_field()}}
						<div class="form-group">
							<input name="user_login" type="text" class="form-control" placeholder="Введіть логін адміністратора" required>
						</div>
						<div class="form-group">
							<input name="user_password" type="password" class="form-control" placeholder="Введіть пароль адміністратора" required>
						</div>

						<div class="form-group">
							<button class="btn btn-primary">
								Увійти
							</button>
						</div>
					</form>
				</div>
			</div>
@endsection