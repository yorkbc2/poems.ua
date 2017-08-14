@extends("app")

@section("content")
			<div class="col-md-4">
				<admin-tabs-app></admin-tabs-app>
			</div>
			<div class="col-md-7 col-md-offset-1">
				<admin-content-app _token="{{csrf_token()}}"></admin-content-app>
			</div>
@endsection