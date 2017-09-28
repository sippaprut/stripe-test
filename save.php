<?php 
          error_reporting(E_ALL);
include_once('vendor/autoload.php');
include( 'config.php' ); 

$payment = new Stripe_driver;



$payment->sk_key = $config['sckey'];
$payment->submit_token = $_POST['stripeToken'];
$payment->submit_email = $_POST['stripeEmail'];


$is_approved = $payment->process( get_charge_amount() );


print_r($payment->getOrder());

// $charge_info = array(
//     'is_approved' => $is_approved,
//     'reason'      => '',
//     'result'      => $payment->getOrder()
// );



// if ( ! $is_approved )
// {
//     if( is_debugger(get_user_email()) and in_array($ccnum, $test_ccnum)) {
//         $charge_info['is_approved'] = true;
//         $charge_info['reason'] = 'TEST MODE';
//     }
// }