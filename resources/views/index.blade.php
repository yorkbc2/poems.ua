@extends("app", ["title" => "Головна"])

@section("content")

	<div class="col-md-6">
		<panel-default heading="Останні новини сайту">
			В розробці
		</panel-default>
	</div>
	<div class="col-md-6">
		<panel-default heading="Останні поезії">
			@if(count($last_poems) > 0) 
				<ol>
				@foreach($last_poems as $poem)

					<li>
						<a href="/poem/{{$poem->id}}">
							{{$poem->title}}
						</a>
					</li>

				@endforeach
				</ol>
			@else

				<h1>
					\_(0_0)_/
				</h1>
				<p>
					Останніх поезій не знайдено :(
				</p>

			@endif
		</panel-default>	
	</div>
	<div class="col-md-12">
		<panel-default heading="Топ поетів по підписникам">
			@php 
				$best_count = 0;
			@endphp
			@foreach($best_authors as $author) 
				@php 
					$best_count++;
				@endphp


			<div class="col-md-4" style="text-align: center">
				@if($best_count == 1)
					<img src="/images/gold.png" alt="Golden Medal" width="100px">
				@elseif($best_count == 2)
					<img src="/images/silver.png" alt="Silver Medal" width="100px">
				@else
					<img src="/images/bronze.png" alt="Bronze Medal" width="100px">
				@endif

				<a class="author-name" href="/profile/{{$author->id}}">
					<h2>
						{{$author->name}}
					</h2>
				</a>
				<span class="follower-span">
					@php

						if($author->followers) {
							echo $author->followers;
						}
						else {
							echo 0;
						}

					@endphp
				</span>

			</div>

			@endforeach
		</panel-default>
	</div>

@endsection