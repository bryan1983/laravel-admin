@extends('LaravelAdmin::layouts.withsidebar')
@section('pageTitle')
    {{isset($pageTitle) ? $pageTitle : "HTTP Requests Logs"}}
@endsection
@section('content')

    <div class="container-fluid admin">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{trans('LaravelAdmin::laravel-admin.httpRequestsTitleDetails')}}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2>General Information</h2>
                        <strong>Requested url:</strong> {{ $request['request']['url'] }}<br />
                        <strong>Date:</strong> {{ $request['date'] }}<br />
                        <strong>Type:</strong> {{ $request['type'] }}<br />
                        <strong>Method:</strong> {!! $request['request']['presented_method'] !!}<br />
                        <strong>HTTP Status Code:</strong> {!! $request['response']['presented_status_code'] !!}<br />
                        <hr />
                        <h2>Request details</h2>
                        <h4>Request headers</h4>
                        <div class="well" style="word-wrap: break-word;">
                            @foreach($request['request']['headers'] as $key => $value)
                                <strong>{{ $key }}:</strong>
                                @if(is_array($value))
                                    {{ $value[0] }}
                                @else
                                    {{ $value }}
                                @endif
                                <br />
                            @endforeach
                        </div>
                        <h4>Request body</h4>
                        @if($request['request']['body_json'])
                            <pre class="prettyprint">{!! json_encode($request['request']['body'], JSON_PRETTY_PRINT) !!}</pre>
                        @else
                            <pre style="word-wrap: break-word;">{!! $request['request']['body'] !!}</pre>
                        @endif()
                        <hr />
                        <h2>Response details</h2>
                        <h4>Response headers</h4>
                        <div class="well" style="word-wrap: break-word;">
                            @foreach($request['response']['headers'] as $key => $value)
                                <strong>{{ $key }}:</strong>
                                @if(is_array($value))
                                    {{ $value[0] }}
                                @else
                                    {{ $value }}
                                @endif
                                <br />
                            @endforeach
                        </div>
                        <h4>Response body</h4>
                        @if($request['response']['body_json'])
                            <pre class="prettyprint">{!! json_encode($request['response']['body'], JSON_PRETTY_PRINT) !!}</pre>
                        @else
                            <pre style="word-wrap: break-word;">{!! $request['response']['body'] !!}</pre>
                        @endif()
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection