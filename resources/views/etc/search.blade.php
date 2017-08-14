@extends("app", ["title" => $query])


@section("content")

	<div class="col-md-6">
		<panel-default heading="Знайдені користувачі">
			@if(count($users) > 0)
				@foreach($users as $user)

					<div class="search-item">
						<h2>
							<a href="/profile/{{$user->id}}">
								{{$user->name}}
							</a>
						</h2>
						<h3>
							<a href="/poems?author={{$user->ulogin}}">
								&#64;{{$user->ulogin}}
							</a>
						</h3>
					</div>

				@endforeach
			@else
				<h1>\(0_0)/</h1>
				<p>
					Користувачів не знайдено!
				</p>
			@endif
		</panel-default>
	</div>
	<div class="col-md-6">
		<panel-default heading="Знайдені поезії">
			@if(count($poems) > 0)
				@foreach($poems as $poem)

					<div class="search-item">
						<h2>
							<a href="/poem/{{$poem->id}}">
								{{$poem->title}}
							</a>
						</h2>
						<h3>
								Автор : <a href="/profile/{{$poem->author_id}}">
									{{$poem->author_name}}
								</a>
						</h3>
						<span>
							Переглянуло: {{$poem->views}} | Зірок: {{$poem->stars}}
						</span>
					</div>

				@endforeach
			@else
				<h1>\(*_*)/</h1>
				<p>
					Поезій не знайдено!
				</p>
			@endif
		</panel-default>
	</div>

@endsection