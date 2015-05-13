@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
{{isset($pageTitle) ? $pageTitle : 'Users'}}
@endsection
@section('content')

<div class="container-fluid admin">
	<h1>{{trans('LaravelAdmin::laravel-admin.usersListTitle')}}</h1>
	<hr />
	{!! $table !!}
</div>

@endsection
