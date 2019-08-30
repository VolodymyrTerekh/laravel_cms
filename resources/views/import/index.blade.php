@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' Импорт товаров')

@section('content')

<div class="page-content browse container-fluid">
	@include('voyager::alerts')
	<?php if(isset($info)){ print_r($info); } ?>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-bordered">
				<div class="panel-body">
					<form method="post" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group">
							<label>Выберите файл для импорта</label>
							<input type="file" name="csv_file" class="form-control" required>
						</div>
						<button class="btn btn-success">Загрузить</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@stop