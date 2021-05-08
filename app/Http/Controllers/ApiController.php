<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function calendar(){
        return $this->get_rtodata(array('type' => 'current'), 'calendar');
    }

    function get_rtodata($args, $endpoint, $header = NULL) {
        $args['api_user'] = env("API_USER");
        $args['api_key'] = env("API_KEY");
        $args['subdomain'] = env("SUBDOMAIN");
        $ch = curl_init(env("API_URL") . $endpoint);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($args));
        if ($header) curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        var_dump($result);
        if (curl_errno($ch)) die(curl_error($ch));
        $data = json_decode($result, true);
        return $data;
        }
}
