@extends("app", ["title" => $title])


@section("content")

<div id="auth">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>
							Реєстрація на сайті
						</h3>
					</div>
					<div class="panel-body">
						@if(isset($error_message))

							<div class="alert alert-danger">
								{{$error_message}}
							</div>

						@endif
						<form action="/auth/up" method="post" class="form-field">
						{{csrf_field()}}
							<div class="form-group">
								<input type="email" name="user_email" placeholder="Введіть Ваш email" required minlength="1" class="form-control" />
							</div>
							<div class="form-group">
								<input type="text" name="user_login" placeholder="Введіть Ваш новий логін" required minlength="1" class="form-control" />
							</div>
							<div class="form-group">
								<input type="text" name="user_name" placeholder="Введіть Ваше ім'я" required minlength="1" class="form-control" />
							</div>
								<label>Вкажіть Вашу дату народження</label>
							<div class="input-group flex-select">


								<select name="user_info_day" class="form-control" id="user_info_day"></select>
								<select name="user_info_month" class="form-control" id="user_info_month"></select>
								<select name="user_info_year" class="form-control" id="user_info_year"></select>
							</div>
							<br>
							<div class="form-group">
								<input type="password" name="user_password" required placeholder="Введіть Ваш новий пароль" class="form-control" />
							</div>
							<div class="form-group">
								<input type="password" name="user_rewrite_password" required placeholder="Повторіть Ваш пароль" class="form-control" />
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary">
									Зареєструватись
								</button>
							</div>

						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3>
							Вхід на сайт 	
						</h3>
					</div>
					<div class="panel-body">
						@if(isset($login_error)) 
							<div class="alert alert-danger">
								{{$login_error_message}}
							</div>
						@endif
						<form action="/auth/in" method="post" class="form-field">
						{{csrf_field()}}
							<div class="form-group">
								<input type="text" name="user_login" placeholder="Ваш логін" required class="form-control" />
							</div>
							<div class="form-group">
								<input type="password" name="user_password" placeholder="Ваш пароль" required class="form-control" />
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">
									Увійти
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>


@endsection