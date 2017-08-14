<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	@if(isset($title))
		<title>{{$title}} - Сучасна поезія</title>
	@else
		<title>Сучасна поезія</title>
	@endif
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
	<link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="/css/poems.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=gs4xnm0wcpoa4jozf0fqrfezhh2oayw3d54i5h38jq57agv9"></script>
  	<script>tinymce.init({ selector:'textarea',
						    setup: function (editor) {
						        editor.on('change', function (e) {
						            editor.save();
						        });
						    } });</script>

	<meta name="csrf-token" content="{{csrf_token() }}" >
</head>
<body>
	
	<div id="app" class="wrapper">
		<nav id="nav">
			<ul>
				<li class="logo">
					<a href="/">
						<img src="/images/logo.png" alt="Сучасна поезія" title="Сучасна | поезія">
					</a>
				</li>

				<li>
					<a href="/poems">
						Всі поезії
					</a>
				</li>

				@php

				if(session()->get("user")) {
					echo "<li>
						<a href='/feed'>
							Лента
						</a>
					</li>";

					echo "<li>
						<a href='/profile/".session()->get("user")["id"]."'>
							Привіт, ".session()->get("user")["name"]."
						</a>
					</li>";

					echo "<li>
						<a href='/logout'>
							Вихід
						</a>
					</li>";
				}
				else {
					echo "<li>
							<a href='/auth'>
								Увійти або зареєструватись
							</a>
						</li>";
				}

				if(session()->get("admin")) {
					echo "
					<li>
						<a href='/admin/panel'>
							Панель адміністратора
						</a>
					</li>
					";
				}

				@endphp

				<li class="unline">
					<form method="get" action="/search">
						<div class="input-group" style="width: 160px;">
						    <input required name="query" type="text" style="width: 140px;" class="form-control" id="inlineFormInputGroup" placeholder="Пошук">
						<div class="input-group-addon">
						<button type="submit" class="tr-button">
							<i class="fa fa-search"></i>
						</button></div>
						 </div>
					</form>
				</li>
				
			</ul>
		</nav>
		<section id="main">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						@yield("content")	
					</div>
					<div class="col-md-4">
						<div class="panel panel-default">
							<div class="panel-body">
								Panel body
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>


	<script src="/js/app.js"></script>
	<script src="/js/select-data.js"></script>

</body>
</html>