<?php
include '../config/constants.php';
// only a post with paystack signature header gets our attention
if ((strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') || !array_key_exists('x-paystack-signature', $_SERVER))
    exit();
// Retrieve the request's body
$input = @file_get_contents("php://input");
define('PAYSTACK_SECRET_KEY', 'sk_test_226c7f616b790d8306315b85db84f3fbf38292e8');
// validate event do all at once to avoid timing attack
if ($_SERVER['HTTP_X_PAYSTACK_SIGNATURE'] !== hash_hmac('sha512', $input, PAYSTACK_SECRET_KEY))
    exit();
http_response_code(200);
// parse event (which is json string) as object
// Do something - that will not take long - with $event
$event = json_decode($input);

if ($event == "subscription.create") {
    $amount = $event['data']['amount'];
    $plan_name = $event['data']['plan']['plan_name'];
    $customer_email = $event['customer']['email'];
    $ref = $event['data']['subscription_code'];

    $query = "SELECT user_id, referral_code FROM users WHERE email=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$customer_email]);
    $result = $stmt->fetch();
    $user_id = $result->user_id;
    $referral_code = $result->referral_code;

    $query_remail = "SELECT email from users WHERE user_id=?";
    $remail_stmt = $pdo->prepare($query_remail);
    $remail_stmt->execute([$referral_code]);
    $result_reml = $remail_stmt->fetch();
    $referral_email = $result_reml->email;

    $query1 = "INSERT INTO sub_history (user_id,sub_id,ref_code) VALUES (?,?,?)";
    $stmt1 = $pdo->prepare($query1);
    $status = $stmt1->execute([$user_id, $plan_name, $ref]);

    if ($status) {
        if ($referral_code != 0) {
            $query10 = "INSERT INTO users (balance) VALUES (?) WHERE user_id=?";
            $stmt10 = $pdo->prepare($query10);
            $status10 = $stmt10->execute([1000, $referral_code]);

            $query20 = "INSERT INTO referral_history (referral,referree,amount) VALUES (?,?,?)";
            $stmt20 = $pdo->prepare($query20);
            $status = $stmt20->execute([$referral_email, $customer_email, 1000]);

            if ($status10) {

                $query100 = "UPDATE users SET referral_code=? WHERE email=?";
                $stmt100 = $pdo->prepare($query100);
                $stmt100->execute([0, $customer_email]);
            }
        }
    }

    exit();
} elseif ($event == "subscription.disable") {
    $amount = $event['data']['amount'];
    $plan_name = $event['data']['plan']['plan_name'];
    $customer_email = $event['customer']['email'];
    $ref = $event['data']['subscription_code'];

    $query = "SELECT user_id FROM users WHERE email=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$customer_email]);
    $result = $stmt->fetch();
    $user_id = $result->user_id;

    $query2 = "UPDATE sub_history SET active=? WHERE user_id=? AND ref_code=? AND sub_id=?";
    $stmt2 = $pdo->prepare($query2);
    $status = $stmt2->execute([0, $user_id, $ref], $plan_name);

    exit();
}
