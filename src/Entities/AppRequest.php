<?php

namespace Joselfonseca\LaravelAdmin\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AppRequest
 * @package Joselfonseca\LaravelAdmin\Entities
 */
class AppRequest extends Model
{

    /**
     * @var string
     */
    protected $table = "app_requests";

    /**
     * @var array
     */
    public $guarded = [];

    /**
     * @return string
     */
    public function presentedMethod()
    {
        switch ($this->request_method){
            case 'GET':
                $return = '<span class="label label-success">GET</span>';
                break;
            case 'POST':
                $return = '<span class="label label-primary">POST</span>';
                break;
            case 'PATCH':
                $return = '<span class="label label-warning">PATCH</span>';
                break;
            case 'PUT':
                $return = '<span class="label label-warning">PUT</span>';
                break;
            case 'DELETE':
                $return = '<span class="label label-danger">DELETE</span>';
                break;
            default:
                $return = '<span class="label label-default">'.$this->request_method.'</span>';
                break;
        }
        return $return;
    }

    /**
     * @return string
     */
    public function presented_status_code()
    {
        $return = '<span class="label label-default">'.$this->status_code.'</span>';
        if($this->status_code >= 200 && $this->status_code <= 299){
            $return = '<span class="label label-success">'.$this->status_code.'</span>';
        } elseif ($this->status_code >= 300 && $this->status_code <= 399){
            $return = '<span class="label label-info">'.$this->status_code.'</span>';
        } elseif ($this->status_code >= 400 && $this->status_code <= 499){
            $return = '<span class="label label-warning">'.$this->status_code.'</span>';
        } elseif ($this->status_code >= 500 && $this->status_code <= 599){
            $return = '<span class="label label-danger">'.$this->status_code.'</span>';
        }
        return $return;
    }

    /**
     * @return array
     */
    public function toPresentedArray()
    {
        $request_body = json_decode($this->request_body, true);
        $response_body = json_decode($this->response_body, true);
        return [
            'id' => $this->id,
            'date' => $this->created_at->format('F j, Y g:i:s a'),
            'type' => $this->type,
            'request' => [
                'url' => $this->url,
                'headers' => json_decode($this->request_headers),
                'presented_method' => $this->presentedMethod(),
                'method' => $this->request_method,
                'body' =>  empty($request_body) ? $this->request_body : $request_body,
                'body_json' => !empty($request_body)
            ],
            'response' => [
                'headers' => json_decode($this->response_headers),
                'status_code' => $this->status_code,
                'presented_status_code' => $this->presented_status_code(),
                'body' => empty($response_body) ? $this->response_body : $response_body,
                'body_json' => !empty($response_body)
            ]
        ];
    }
}