<?php
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $amount = $_POST['amount'] * 100;
    $sub_id = $_POST['sub_id'];

    $_SESSION['payment_sub_id'] = $sub_id;
    $_SESSION['payment_email'] = $email;
    $_SESSION['payment_amount'] = $_POST['amount'];

    if ($sub_id == 1) {
        $plan_code = 'PLN_4wuc4at7th62c5l';
    } elseif ($sub_id == 2) {
        $plan_code = 'PLN_7kikf16qjy25idl';
    } elseif ($sub_id == 3) {
        $plan_code = 'PLN_cl6jlascbzkc8wa';
    } else {
        $plan_code = 'nothing';
    }

    // die($plan_code);
    // $plan_code = $tranx['data']['plan_code'];

    $url = "https://api.paystack.co/transaction/initialize";
    $fields = [
        'email' => $email,
        'amount' => $amount,
        'plan' => $plan_code
    ];
    $fields_string = http_build_query($fields);
    //open connection
    $ch = curl_init();

    //set the url, number of POST vars, POST data
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer sk_test_226c7f616b790d8306315b85db84f3fbf38292e8",
        "Cache-Control: no-cache",
    ));

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //execute post
    $result = curl_exec($ch);
    $err2 = curl_error($ch);

    if ($err2) {
        // there was an error contacting the Paystack API
        die('Curl returned error: ' . $err2);
    }

    $datas = json_decode($result, true);

    if (!$datas['status']) {
        // there was an error from the API
        print_r('API returned error: ' . $datas['message']);
    }

    if ($datas['data']['authorization_url']) {
        $_SESSION['ref_sub'] = $datas->data->reference;
        header('Location: ' . $datas['data']['authorization_url']);
    }

    // echo $result;

}
