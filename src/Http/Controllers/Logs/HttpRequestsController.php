<?php

namespace Joselfonseca\LaravelAdmin\Http\Controllers\Logs;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Joselfonseca\LaravelAdmin\Entities\AppRequest;
use Joselfonseca\LaravelAdmin\Http\Controllers\Controller;

/**
 * Class HttpRequestsController
 * @package Joselfonseca\LaravelAdmin\Http\Controllers\Logs
 */
class HttpRequestsController extends Controller
{

    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $statusCodes = AppRequest::select('status_code')
            ->distinct('status_code')->get()->pluck('status_code', 'status_code')->toArray();
        $logs = AppRequest::orderBy('created_at', 'desc');
        list($logs, $date) = $this->applyFilter($request, $logs);
        return view('LaravelAdmin::logs.index', compact('statusCodes', 'date'))
            ->with('logs', $logs->paginate(2))
            ->with('status_code', $request->get('status-code', null))
            ->with('activeMenu', 'sidebar.logs.requests');
    }

    /**
     * @param $id
     * @return $this
     */
    public function show($id)
    {
        $request = AppRequest::findOrFail($id)->toPresentedArray();
        return view('LaravelAdmin::logs.detail', compact('request'))
            ->with('activeMenu', 'sidebar.logs.requests');
    }

    /**
     * @param Request $request
     * @param $logs
     * @return array
     */
    protected function applyFilter(Request $request, $logs)
    {
        if ($request->has('status-code') && !empty($request->get('status-code'))) {
            $logs = $logs->where('status_code', $request->get('status-code'));
        }
        $date = $request->get('date', Carbon::now()->startOfDay()->format('m/d/Y h:i A') . ' - ' . Carbon::now()->endOfDay()->subMinutes('29')->format('m/d/Y h:i A'));
        if (!empty($date)) {
            $dates = explode(' - ', $date);
            $startDate = Carbon::parse(trim($dates[0]));
            $endDate = Carbon::parse(trim($dates[1]));
            if (!empty($endDate) && !empty($startDate)) {
                $logs = $logs->where('created_at', '>=', $startDate)->where('created_at', '<=', $endDate);
            }
        }
        return array($logs, $date);
    }

}