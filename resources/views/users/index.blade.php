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
			<table id="users-table" class="table table-condensed">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
@section('scripts')
	<script>
		$(function() {
			$('#users-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: '{{ route('LaravelAdminUsers') }}',
				columns: [
					{data: 0, name: 'id'},
					{data: 1, name: 'name'},
					{data: 2, name: 'email'},
					{data: 3, name: 'action', orderable: false, searchable: false}
				]
			});
		});
	</script>
@endsection
