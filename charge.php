<?php
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');
error_reporting(E_ALL ^ E_NOTICE);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ob_start(); print_r($_POST);echo '<br><br><pre>';

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
  'body' => '{"amount":1,"currency":"KWD","customer_initiated":true,"threeDSecure":true,"save_card":false,"payment_agreement":{"id":"payment_agreement_TS07A4620230032t4K21406294"},"description":"Test Description","metadata":{"udf1":"Metadata 1"},"reference":{"transaction":"txn_01","order":"ord_01"},"receipt":{"email":true,"sms":true},"customer":{"first_name":"test","middle_name":"test","last_name":"test","email":"test@test.com","phone":{"country_code":965,"number":51234567},"id":"cus_TS01A4620230032p4KP1406279"},"merchant":{"id":"1234"},"source":{"id":"tok_2uKe58232153ZmxV138r5c637"},"post":{"url":"http://your_website.com/post_url"},"redirect":{"url":"http://your_website.com/redirect_url"}}',
  'headers' => [
    'Authorization' => 'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ',
    'accept' => 'application/json',
    'content-type' => 'application/json',
  ],
]);

echo $response->getBody(); 
 
  
   
*/

$body= [
    "amount" => 1,
    "currency" => "SAR",
    "customer_initiated" => true,
    "threeDSecure" => false,
    "save_card" => false,
//    "payment_agreement"=> ["id"=>"payment_agreement_TS07A4620230032t4K21406294"],
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
//    "merchant"=>["id"=>"1234"],
    "source"=>["id"=>$_POST["tapToken"]],
    "post"=>["url"=>"http://your_website.com/post_url"],
    "redirect"=>["url"=>"http://your_website.com/redirect_url"]];

$bodyJSON='{
    "amount": 1,
    "currency": "SAR",
    "customer_initiated": true,
    "threeDSecure": false,
    "save_card": false,
    "description": "Test Description",
    "metadata": {
        "udf1": "Metadata 1"
    },
    "reference": {
        "transaction": "txn_01",
        "order": "ord_01"
    },
    "receipt": {
        "email": true,
        "sms": true
    },
    "customer": {
        "first_name": "test",
        "middle_name": "test",
        "last_name": "test",
        "email": "test@test.com",
        "phone": {
            "country_code": 965,
            "number": 51234567
        }
    },
    "source": {
        "id": "'. $_POST["tapToken"]. '"
    },
    "post": {
        "url": "http://your_website.com/post_url"
    },
    "redirect": {
        "url": "http://your_website.com/redirect_url"
    }
}';


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.tap.company/v2/charges/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POST => true ,
//            CURLOPT_POSTFIELDS => json_encode($body, true),
            CURLOPT_POSTFIELDS => $bodyJSON,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ',
                'Accept: application/json',
                'Content-Type: application/json',
              ],
        ));
        
        /**
         * @todo TO BE REMOVED
         */
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, False);

        
        $responseJSON = curl_exec($curl);
        $response = json_decode($responseJSON, true);
        var_dump($response);
        
        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl);
        }else{
            ob_end_clean();            
            if($response['status']== 'CAPTURED' || in_array($response['response']['code'], ['000', '001', '002']) ){
                header("Location: success.php");
            }else{
                header("Location: failed.php?rspmsg=". $response['response']['message']. "&acqmsg=". $response['acquirer']['response']['message']);
            }
        }
        
        curl_close($curl);
