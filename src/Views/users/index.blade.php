@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Users'}}
@endsection
@section('content')

<div class="container-fluid admin">
	<div class="box">
		<div class="box-header with-border">
			<h3 class="box-title">{{trans('LaravelAdmin::laravel-admin.usersListTitle')}}</h3>
			<div class="box-tools">
				<a href="{{route('LaravelAdminUsersCreate')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> {{trans('LaravelAdmin::laravel-admin.createUserTitle')}}</a>
			</div>
		</div>
		<div class="box-body">
			{!! $table !!}	
		</div>
	</div>
</div>

@endsection
