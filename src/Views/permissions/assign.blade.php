@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Permissions'}}
@endsection
@section('content')

<div class="container-fluid admin">
	<div class="panel panel-primary">
		<div class="panel-heading">
			{{trans('LaravelAdmin::laravel-admin.managePermissions')}}
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
                		
                    </div>
	            </div>
	        </div>		
		</div>
	</div>
</div>

@endsection