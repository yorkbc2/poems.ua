@extends("app", ["title" => "Успішно"])

@section("content")

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="alert alert-success">
						{!! $text !!}
					</div>
				</div>
			</div>

@endsection