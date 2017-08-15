@extends("app", ["title" => "Лента"])


@section("content")


	<div class="col-md-4">
		<panel-default heading="Пошук по категоріям">
		<ul>
			@foreach($categories as $cat) 
	
				<li>
					<a href="/feed?category={{$cat->id}}">
						{{$cat->title}}
					</a>
				</li>

			@endforeach
		</ul>
		</panel-default>

		<panel-default heading="Пошук по авторам">
		<ul>
			@foreach($users as $u) 
	
				<li>
					<a href="/feed?author={{$u->id}}">
						&#64;{{$u->ulogin}}
					</a>
				</li>

			@endforeach
		</ul>
		</panel-default>
	</div>
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-body">
				@if(count($poems) > 0)
					@foreach($poems as $poem)

						<div class="panel poem panel-default">
							<div class="panel-body">
							<span>
								Переглянуло: {{$poem->views}} | Зірок: {{$poem->stars}} 
							</span>
								<h2>
									<a style="color: #333; text-decoration: none;" href="/poem/{{$poem->id}}">
										{{$poem->title}}
									</a>
									
								</h2>
								
							<span>
								Автор: <a style="color: #333; text-decoration: none;" href="/profile/{{$poem->author_id}}">
									{{$poem->author_name}}
								</a>
							</span>
							</div>
						</div>

					@endforeach
				@else

					<h1>
						\(^_^)/
					</h1>
					@if(isset($category_name))
						<p>
							Поезій з категорією "{{$category_name}}" в ленті не знайдено!
						</p>
					@else 
						<p>
							Поезій з в ленті не знайдено!
						</p>
					@endif

				@endif
			</div>
		</div>
	</div>

@endsection