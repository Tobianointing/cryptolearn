<?php
require_once '../config/constants.php';

$sub_id = $_SESSION['payment_sub_id'];
$p_user_id = $_SESSION['user_id'];

unset($_SESSION['payment_sub_id']);
unset($_SESSION['payment_amount']);

$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if (!$reference) {
    die('No reference supplied');
}

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "authorization: Bearer sk_test_226c7f616b790d8306315b85db84f3fbf38292e8",
        "cache-control: no-cache"
    ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if ($err) {
    // there was an error contacting the Paystack API
    die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);

if (!$tranx->status) {
    // there was an error from the API
    die('API returned error: ' . $tranx->message);
}

if ('success' == $tranx->data->status) {
    // transaction was successful...
    // please check other things like whether you already gave value for this ref
    // if the email matches the customer who owns the product etc
    $query = "INSERT INTO sub_history (user_id, sub_id, ref_code) VALUES (?,?,?)";
    $stmt = $pdo->prepare($query);
    $status = $stmt->execute([$p_user_id, $sub_id, $reference]);

    if($status){
        header("Location: payment_success.php");
    }
    // Give value
    // var_dump($_SESSION);
}
