<?php 

include_once('vendor/autoload.php');

$payment = new Stripe_driver;

print_r($_POST);

// $payment->sk_key = $config['sckey'];
// $payment->submit_token = getValue( $user_session['checkout']['cc_info']['stripe_token'] );
// $payment->submit_email = getValue( $user_session['checkout']['cc_info']['stripe_email'] );


//             $is_approved = $payment->process( get_charge_amount() );
//             error_reporting(E_ALL);
            
//             devprint($payment->getOrder());

//             $charge_info = array(
//                 'is_approved' => $is_approved,
//                 'reason'      => '',
//                 'result'      => $payment->getOrder()
//             );

            

//             if ( ! $is_approved )
//             {
//                 if( is_debugger(get_user_email()) and in_array($ccnum, $test_ccnum)) {
//                     $charge_info['is_approved'] = true;
//                     $charge_info['reason'] = 'TEST MODE';
//                 }
//             }