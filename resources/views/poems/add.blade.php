@extends("app", ["title" => $title])

@section("content")

			<div class="panel panel-default">
				
				<div class="panel-body">
					<form enctype="multipart/form-data" 
					  action="/add" 
					  method="post" 
					  class="form-field">

					  {{csrf_field()}}
					
						<div class="form-group">
							<input placeholder="Заголовок поеми *" name="poem_title" type="text" class="form-control" required>
						</div>
						<div class="form-group">
							<select name="poem_category" class="form-control" required>
								@foreach($cats as $cat)
	
									<option value="{{$cat->id}}">
										{{$cat->title}}
									</option>

								@endforeach
							</select>
						</div>
						<div class="form-group">
							<textarea rows="10" placeholder="Ваша поема тут..." name="poem_content" class="form-control" required class="poem_textarea" maxlength="1000"></textarea>
						</div>
						<div class="form-group">
							<label for="poem_image">
								Завантажити обкладинку
							</label>
							<input name="poem_image" type="file" class="form-control" id="poem_image">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">
								Додати +
							</button>
						</div>

					</form>
				</div>

			</div>
@endsection