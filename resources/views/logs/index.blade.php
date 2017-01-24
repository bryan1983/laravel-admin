@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "HTTP Requests Logs"}}
@endsection
@section('contentHeader')
    <h3>{{trans('LaravelAdmin::laravel-admin.httpRequestsTitle')}}</h3>
@endsection
@section('content')

    <div class="container-fluid admin">
        {!! Form::open(['method' => 'GET']) !!}
        <div class="row">
            <div class="col-md-2">
                {!! Field::select('status-code', $statusCodes, request('status-code'), ['label' => 'Status Code', 'class' => 'select2']) !!}
            </div>
            <div class="col-md-4">
                {!! Field::text('uri', request('uri'), ['label' => 'Uri (without domain and protocol)']) !!}
            </div>
            <div class="col-md-2">
                {!! Field::select('method', ['GET' => 'GET', 'POST' => 'POST', 'PATCH' => 'PATCH', 'PUT' => 'PUT', 'DELETE' => 'DELETE'], request('method'), ['label' => 'Method', 'class' => 'select2']) !!}
            </div>
            <div class="col-md-4">
                {!! Field::text('date', $date, ['label' => 'Date range', 'class' => 'rangepicker']) !!}
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-search"></i> Filter</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-danger btn-block cleanup-logs" type="button"><i class="fa fa-trash-o"></i> Clean up old logs</button>
            </div>
        </div>
        {!! Form::close() !!}
        <hr />
        Total Records: {{ $logs->total() }}
        <div class="box">
            <div class="box-body no-padding">
                <table class="table table-condensed text-center">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Url</th>
                        <th>Type</th>
                        <th>Method</th>
                        <th>Status code</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->created_at->format('F j, Y g:i:s a') }}</td>
                                <td>{{ $log->url }}</td>
                                <td>{{ $log->type }}</td>
                                <td style="padding-top: 13px" class="text-center">{!! $log->presentedMethod() !!}</td>
                                <td style="padding-top: 13px" class="text-center">{!! $log->presented_status_code() !!}</td>
                                <td class="text-center">
                                    <a class="btn btn-info btn-sm" href="{{ route('LaravelAdminLogsRequestsDetail', $log->id) }}"><i class="fa fa-info"></i> Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer text-center">
                {!! $logs->appends(['status-code' => $status_code, 'date' => $date, 'uri' => request('uri'), 'method' => request('method')])->render() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function(){
            $('.rangepicker').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY h:mm A'
                }
            });

            $(document).on('click', '.cleanup-logs', function(){
                swal({
                    title: "Are you sure?",
                    text: "We will only keep the last month of API requests",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true
                },
                function(){
                    $.ajax({
                        type: 'DELETE',
                        url: GLOBALS.site_url+'/'+'{{ config('laravel-admin.routePrefix', 'backend') }}'+'/system-logs/requests',
                        dataType: 'JSON',
                        data: {
                            '_token': GLOBALS.token
                        },
                        complete: function() {
                            window.location.reload();
                        }
                    });
                });
            });
        })
    </script>
@endsection
