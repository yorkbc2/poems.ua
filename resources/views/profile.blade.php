@extends("app", ["title" => $title])

@section("content")

@if(!isset($profile->name) AND !isset($profile->id))


				<div class="alert alert-danger">
					<h3>
						Користувача не знайдено!
					</h3>
					<strong>
						Помилка.
					</strong>
					Користувача не знайдено, можливо він видалив свій профіль або його не існувало взагалі.
				</div>
@else
				<div class="panel panel-default">
					<div class="panel-body">
						<h1>
							{{$profile->name}}
						</h1>
						<h3>
							&#64;{{$profile->ulogin}} 
							@if(isset($isProfile))

								<a class="btn btn-default" href="/followers">
									Стежать: <u style="font-family: 'Open Sans', sans-serif; font-weight: bolder;">{{count($followers)}}</u>
								</a>

								<a class="btn btn-default" href="/following">
									Читаю: <u style="font-family: 'Open Sans', sans-serif; font-weight: bolder;">{{count($following)}}</u>
								</a>

								<a class="btn btn-default" href="/settings">
									Налаштування
								</a>

								<a class="btn btn-primary" href="/add">
									Додати +
								</a>


	
							@else
								@if(session()->get("user"))
									<a href="/profile/{{$profile->id}}/followers" class="btn btn-default">Читачі: <u id="followers-number" style="font-family: 'Open Sans', sans-serif; font-weight: bolder;">{{count($followers)}}</u></a>
									<follow-button token="{{csrf_token()}}" profile="{{$profile->id}}" user="{{session()->get("user")["id"]}}" follow="{{$isFollow}}">	
									</follow-button>
								@else
									<fake-follow-button></fake-follow-button>
								@endif

							@endif
						</h3>
					</div>
				</div>
				<br>
				<div class="panel panel-default">
					<div class="panel-body">
						@if(count($poems) > 0)
							@php 
								$poems = json_encode($poems, true);
								$star_poems = json_encode($star_poems, true);
							@endphp

							<profile-poems 
								user="{{session()->get("user")["id"]}}" 
								poems="{{$poems}}" 
								spoems="{{$star_poems}}"
								token="{{csrf_token()}}"></profile-poems>

						@else
							<div class="alert" style="text-align:center;">
								<h1 >
									\(-_-)/
								</h1>
								<p>
									Композицій не знайдено!
								</p>
								@if(isset($isProfile))
								<p>
									<a class="btn btn-primary" href="/add">
											Додати зараз
									</a>
								</p>
								@endif
							</div>
						@endif
					</div>
				</div>
@endif
@endsection