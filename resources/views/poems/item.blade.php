@extends("app", ["title" => $poem->title])


@section("content")

				<div class="panel panel-default">
					<div class="panel-body" style="text-align: center;">
						<div class="poem-toolbar">	
							@if(session()->get("user"))
								
								@if(session()->get("user")["id"] != $poem->author_id)

									<star-button user="{{session()->get("user")["id"]}}"
											poem="{{$poem->id}}"
											stared="{{$stared}}"
											token="{{csrf_token()}}"></star-button>
								@endif
								
							@endif
							<button class="btn btn-default">
								<span class="glyphicon glyphicon-flag"></span>
							</button>
						</div>
						<h1>
							{{$poem->title}}
						</h1>
						<p>
							Категорія: <a href='/category/{{$poem->category_id}}'>{{$category_name}}</a>
						</p>
						<div class="little-line"></div>
						<div class="poem-content">
							{!! $poem->content !!}
						</div>
						<div class="little-line"></div>
						<p>	
							Автор: <a href='/profile/{{$poem->author_id}}'>
								{{$poem->author_name}}
							</a>
							&nbsp;
							Переглядів: {{$poem->views}}
							&nbsp;
							Зірок: {{$poem->stars}}
						</p>
						<p>	
							Більше від автора: <a href="/poems?author={{$author_login}}">
								&#64;{{$author_login}}
							</a>
						</p>
					</div>
					<div class="panel-body">
						<h2>Рецензії на поему : </h2>
						<form class="form-field" v-on:submit.prevent="setReview($event)">
							{{csrf_field()}}
							<input type="hidden" name="post_id" id="post_id_hidden" value="{{$poem->id}}">
							<div class="form-group">
								<textarea class="form-control"></textarea>
							</div>
							<div class="form-group">
								<button class="btn btn-primary">
									Додати рецензію
								</button>
							</div>
						</form>
						<div class="little-line"></div>
						<div class="reviews" id="reviews">
							@if(count($reviews) > 0) 
								@foreach($reviews as $review)
									<div class="review">
										<div class="review-header">
											<h2><a href="/profile/{{$review->author_id}}">
												{{$review->author_name}} &#64;{{$review->author_login}}
											</a></h2>
											<p>
												{!!$review->content!!}
											</p>
											@if($review->created_at)
											<span>
												{{$review->created_at}}
											</span>
											<br>
											@endif
										</div>
									</div>
								@endforeach
							@else
							<div id="no-reviews">
								<h1 style="text-align: center">
									\(0_0)/
								</h1>
								<h4 style="text-align: center">
									На жаль, рецензій немає!
								</h4>
							</div>
							@endif
						</div>
					</div>
				</div>
@endsection