<?php
ini_set('display_errors', 1); ini_set('log_errors', 1); ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); error_reporting(E_ALL ^ E_NOTICE);

ob_start(); print_r($_POST);echo '<br><br><pre>';

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
            CURLOPT_POSTFIELDS => $bodyJSON,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ',
                'Accept: application/json',
                'Content-Type: application/json',
              ],
        ));

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