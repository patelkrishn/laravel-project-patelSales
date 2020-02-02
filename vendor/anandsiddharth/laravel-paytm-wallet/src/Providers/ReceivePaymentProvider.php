<?php

namespace Anand\LaravelPaytmWallet\Providers;
use Anand\LaravelPaytmWallet\Facades\PaytmWallet;
use Anand\LaravelPaytmWallet\Traits\HasTransactionStatus;
use Illuminate\Http\Request;

class ReceivePaymentProvider extends PaytmWalletProvider{
	use HasTransactionStatus;
	
	private $parameters = null;
	private $view = 'paytmwallet::transact';

    public function prepare($params = array()){
		$defaults = [
			'order' => NULL,
			'user' => NULL,
			'amount' => NULL,
            'callback_url' => NULL,
            'email' => NULL,
            'mobile_number' => NULL,
		];

		$_p = array_merge($defaults, $params);
		foreach ($_p as $key => $value) {

			if ($value == NULL) {
				
				throw new \Exception(' \''.$key.'\' parameter not specified in array passed in prepare() method');
				
				return false;
			}
		}
		$this->parameters = $_p;
		return $this;
	}

	public function receive(){
		if ($this->parameters == null) {
			throw new \Exception("prepare() method not called");
		}
		return $this->beginTransaction();
	}

	public function view($view) {
		if($view) {
			$this->view = $view;
		}
		return $this;
	}

	private function beginTransaction(){
		$params = [
			'REQUEST_TYPE' => 'DEFAULT',
			'MID' => $this->merchant_id,
			'ORDER_ID' => $this->parameters['order'],
			'CUST_ID' => $this->parameters['user'],
			'INDUSTRY_TYPE_ID' => $this->industry_type,
			'CHANNEL_ID' => $this->channel,
			'TXN_AMOUNT' => $this->parameters['amount'],
			'WEBSITE' => $this->merchant_website,
            'CALLBACK_URL' => $this->parameters['callback_url'],
            'MOBILE_NO' => $this->parameters['mobile_number'],
            'EMAIL' => $this->parameters['email'],
		];
		$output='
		<html>
		<head>
		<title>Merchant Check Out Page</title>
		</head>
		<body>
			<br>
			<br>
			<center><h1>Your transaction is being processed!!!</h1></center>
			<center><h2>Please do not refresh this page...</h2></center>';
			$output.='<form method="post" action="'.$this->paytm_txn_url.'" name="f1">
			<table border="1">
				<tbody>';
				foreach ($params as $key => $value){
			$output.='<input type="hidden" name="'.$key.'"  value="'.$value.'" />';
						}
				$output.='<input type="hidden" name="CHECKSUMHASH" value="'.getChecksumFromArray($params, $this->merchant_key).'">
				</tbody>
			</table>
			<script type="text/javascript">
				document.f1.submit();
			</script>
		</form>';
		$output.='
		</body>
		</html>';
		
	echo $output;
		// return view('paytmwallet::form')->with('view', $this->view)->with('params', $params)->with('txn_url', $this->paytm_txn_url)->with('checkSum', getChecksumFromArray($params, $this->merchant_key));
	}

    public function getOrderId(){
        return $this->response()['ORDERID'];
    }
    public function getTransactionId(){
        return $this->response()['TXNID'];
    }

}
