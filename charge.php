<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

print_r($_POST);



//require_once('vendor/autoload.php');
//$client = new \GuzzleHttp\Client();
/*
$response = $client->request('POST', 'https://api.tap.company/v2/tokens', [
  'headers' => [
    'Authorization' => 'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ',
    'accept' => 'application/json',
    'content-type' => 'application/json',
  ],
]);

echo $response->getBody();


$response = $client->request('POST', 'https://api.tap.company/v2/tokens', [
  'body' => '{"card":{"number":4508750015741019,"exp_month":1,"exp_year":2039,"cvc":100,"name":"test user","address":{"country":"Kuwait","line1":"Salmiya, 21","city":"Kuwait city","street":"Salim","avenue":"Gulf"}},"client_ip":"192.168.1.20"}',
  'headers' => [
    'Authorization' => 'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ',
    'accept' => 'application/json',
    'content-type' => 'application/json',
  ],
]);
 
 
 $response = $client->request('POST', 'https://api.tap.company/v2/charges/', [
  'body' => '{"amount":1,"currency":"KWD","customer_initiated":true,"threeDSecure":true,"save_card":false,"description":"Test Description","metadata":{"udf1":"Metadata 1"},"reference":{"transaction":"txn_01","order":"ord_01"},"receipt":{"email":true,"sms":true},"customer":{"first_name":"test","middle_name":"test","last_name":"test","email":"test@test.com","phone":{"country_code":965,"number":51234567}},"merchant":{"id":"1234"},"source":{"id":"src_all"},"post":{"url":"http://your_website.com/post_url"},"redirect":{"url":"http://your_website.com/redirect_url"}}',
  'headers' => [
    'Authorization' => 'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ',
    'accept' => 'application/json',
    'content-type' => 'application/json',
  ],
]);

echo $response->getBody(); 
 
  
   
*/

$body= ["amount" => 1,
    "currency" => "SAR",
    "customer_initiated" => true,
    "threeDSecure" => true,
    "save_card" => false,
    "description" => "Test Description",
    "metadata" => ["udf1" => "Metadata 1"],
    "reference"=> [
        "transaction"=>"txn_01",
        "order"=>"ord_01"],
    "receipt"=>["email"=>true,
        "sms"=>true],
    "customer"=>[ 
        "first_name"=>"test",
        "middle_name"=>"test",
        "last_name"=>"test",
        "email"=>"test@test.com",
        "phone"=>["country_code"=>965,
            "number"=>51234567]],
    "merchant"=>["id"=>"1234"],
    "source"=>["id"=>"src_all"],
    "post"=>["url"=>"http://your_website.com/post_url"],
    "redirect"=>["url"=>"http://your_website.com/redirect_url"]];

$data['profile_id'] = $this::PROFILE_ID;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tap.company/v2/tokens',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => isset($request_method) ? $request_method : 'POST',
            CURLOPT_POSTFIELDS => json_encode($body, true),
            CURLOPT_HTTPHEADER => [
                'Authorization' => 'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ',
                'accept' => 'application/json',
                'content-type' => 'application/json',
              ],
        ));
        
        $response = json_decode(curl_exec($curl), true);
        curl_close($curl);
        echo $response;
