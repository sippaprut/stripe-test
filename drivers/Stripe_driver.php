<?php
  error_reporting(E_ALL);

class Stripe_driver {

	public $sk_key = '';

	public $submit_token = '';

	public $submit_email = '';

	public $order = array();

	public $approved = false ;

	public $declined = false ;

	public $duplicated = false ;

	public $error = true;

	
	public function process( $total = 0 ) {

		try {
			
			\Stripe\Stripe::setApiKey( $this->sk_key );

			$reponse = \Stripe\Customer::create(array(
	            'email' => $this->submit_email ,
	            'card'  => $this->submit_token
	        ));

			$this->order = \Stripe\Charge::create(array(
	            'customer' => $reponse->id,
	            'amount'   => $this->convert_total( $total ) ,
	            'currency' => 'usd'
	        ));

	        $this->approved = true;

	        $this->declined = false;

	        $this->error = false;

	        return true;
		} 

		catch(\Stripe\Error\Card $e) {

			$obj = $e->getJsonBody();

			$this->error = true;

			$this->declined = true;

			$this->approved = false;

			$this->order = $obj['error'];

			return false;

		}

		catch (\Stripe\Error\RateLimit $e) {
		  // Too many requests made to the API too quickly
		  $obj = $e->getJsonBody();

			$this->error = true;

			$this->declined = true;

			$this->approved = false;

			$this->order = $obj['error'];

			return false;
		} 
		catch (\Stripe\Error\InvalidRequest $e) {
		  // Invalid parameters were supplied to Stripe's API
		 	 $obj = $e->getJsonBody();

			$this->error = true;

			$this->declined = true;

			$this->approved = false;

			$this->order = $obj['error'];

			return false;
		} 

		catch (\Stripe\Error\Authentication $e) {
		  // Authentication with Stripe's API failed
		  // (maybe you changed API keys recently)
		  $obj = $e->getJsonBody();

			$this->error = true;

			$this->declined = true;

			$this->approved = false;

			$this->order = $obj['error'];

			return false;
		} 

		catch (\Stripe\Error\ApiConnection $e) {
		  // Network communication with Stripe failed
		  	$obj = $e->getJsonBody();

			$this->error = true;

			$this->declined = true;

			$this->approved = false;

			$this->order = $obj['error'];

			return false;
		} 
		catch (\Stripe\Error\Base $e) {
		  // Display a very generic error to the user, and maybe send
		  	$obj = $e->getJsonBody();

			$this->error = true;

			$this->declined = true;

			$this->approved = false;

			$this->order = $obj['error'];

			return false;
		} 
		catch (Exception $e) {
		  // Something else happened, completely unrelated to Stripe
		}
			
	}

	public function get_order()
	{
		return $this->order;
	}

	public function convert_total( $total )
	{
		return str_replace("." , "" , number_format($total , 2 , '' , '') );
	}

	public function get_FullResult(){
        return $this->order;
    }


}