@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Permissions'}}
@endsection
@section('content')

<div class="container-fluid admin">
	<div class="panel panel-primary">
		<div class="panel-heading">
			{{trans('LaravelAdmin::laravel-admin.managePermissions'). ' - '.$model->name}}
		</div>
		<div class="panel-body">
			<div class="row">
	            <div class="col-lg-12 col-md-12 col-xs-12">
                	<div class="row">
                		<div class="col-lg-12">
                			@include('flash::message')
                		</div>
                	</div>
                	<div class="row">
						@foreach($permissions as $permission) 
						<div class="col-lg-4">
							<div class="form-group">
								<label>
									<h4>{{ $permission['model']->name }}</h4>
									<small>{{ $permission['model']->description }}</small><br />
								</label>
							</div>
						</div>
						@endforeach
                    </div>
	            </div>
	        </div>		
		</div>
	</div>
</div>

@endsection