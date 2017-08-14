@extends("app", ["title" => "Підписники"])


@section("content")

<div class="panel panel-default">
	
	<div class="panel-body">
		
		@if(count($followers) < 1)

			<h2>
				\(^_^)/
			</h2>
			<p>
				Підписок не знайдено!
			</p>

		@else
			<div class="following-list">
			<input type="hidden" id="hidden_token" value="{{csrf_token()}}">
			@foreach($followers as $following)

				<div class="following">
					<div>
						<h2>
							<a href="/profile/{{$following->id}}">
								{{$following->name}}
							</a>
						</h2>
					</div>
					<div>
						<h3>
							<a href="/poems?author={{$following->ulogin}}">
								&#64;{{$following->ulogin}}
							</a>
						</h3>
					</div>
						<follow-button follow="true" profile="{{$following->id}}" user="{{session()->get("user")["id"]}}" token="{{csrf_token()}}"></follow-button>
				</div>

			@endforeach
			</div>

		@endif



	</div>

</div>

@endsection