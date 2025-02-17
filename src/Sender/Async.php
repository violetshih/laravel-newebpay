<?php

namespace Violetshih\NewebPay\Sender;

use GuzzleHttp\Client;
use Violetshih\NewebPay\Contracts\Http;
use Violetshih\NewebPay\Contracts\Sender;

class Async implements Sender, Http
{
    /**
     * The guzzle http client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    /**
     * Create a new async instance.
     *
     * @param  \GuzzleHttp\Client  $client
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->http = $client;
    }

    /**
     * Send the data to API.
     *
     * @param  array  $request
     * @param  string  $url
     * @return mixed
     */
    public function send($request, $url, $headers = [])
    {
        $parameter = [
            'form_params' => $request,
            'verify' => false,
        ];
        if(!empty($headers)){
            $parameter["headers"] = $headers;
        }
        $response = $this->http->post($url, $parameter)->getBody();
        $result = json_decode($response, true);
        if($result === null){
            parse_str($response, $result);
        }
        
        return $result;
    }

    /**
     * Set mock http client instance.
     *
     * @param  \GuzzleHttp\Client  $client
     * @return self
     */
    public function setHttp(Client $client)
    {
        $this->http = $client;

        return $this;
    }
}
