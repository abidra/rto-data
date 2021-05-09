<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function calendar(Request $request){
        $type = $request->input('type');
        $start = $request->input('start');
        $end = $request->input('end');
        $location = $request->input('location');
        $region = $request->input('region');
        return $this->get_rtodata(array(
            'type' => $type,
            'start' => $start,
            'end' => $end,
            'location' => $location,
            'region' => $region,
        ), 'calendar');
    }
    public function check(Request $request){
        $type = $request->input('type');
        $number = $request->input('number');
        $learner_id = $request->input('learner_id');
        $enrolment_id = $request->input('enrolment_id');
        $last_name = $request->input('last_name');
        return $this->get_rtodata(array(
            'type' => $type,
            'number' => $number ,
            'learner_id' => $learner_id,
            'enrolment_id' => $enrolment_id,
            'last_name' => $last_name,
        ), 'check');
    }
    public function detail(){
        $code = $request->input('code');
        $plan = $request->input('plan');
        return $this->get_rtodata(array(
            'code' => $code,
            'plan' => $plan,
        ), 'detail');
    }
    public function enrol(){
        $values = $request->input('values');
        return $this->get_rtodata(array(
            'code' => $values,
        ), 'enrol');
    }
    public function list(){
        $type = $request->input('type');
        $category = $request->input('category');
        $plan = $request->input('plan');
        $from = $request->input('from');
        return $this->get_rtodata(array(
            'type' => $type,
            'category' => $category,
            'plan' => $plan,
            'from' => $from,
        ), 'list');
    }
    public function recieve(){
        $enrolment_id = $request->input('enrolment_id');
        $files = $request->input('files');

        return $this->get_rtodata(array
        'enrolment_id' => $enrolment_id,
        'files' => $files,
    ), 'recieve');
    }
    public function update(){
        $type = $request->input('type');
        $person_id = $request->input('person_id');
        $enrolment_id = $request->input('enrolment_id');
        $payment_plan_id = $request->input('payment_plan_id');
        $payment_received = $request->input('payment_received');
        $transaction_id = $request->input('transaction_id');
        $data = $request->input('data');

        return $this->get_rtodata(array(
            'type' => $type,
            'person_id' => $person_id,
            'enrolment_id' => $enrolment_id,
            'payment_plan_id' => $payment_plan_id,
            'payment_received' => $payment_received,
            'transaction_id' => $transaction_id,
            'data' => $data,
        ), 'check');
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
