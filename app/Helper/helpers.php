<?php 
	
	function successResponse($msg='',$data=[],$status=200)
	{
		return response()->json(['error'=>false,'status'=>$status,'message'=>$msg,'data'=>$data]);
	}

	function errorResponse($msg='',$data=[],$status=200)
	{
		return response()->json(['error'=>true,'status'=>$status,'message'=>$msg,'data'=>$data]);
	}

	function emptyCheck($string,$date=false)
	{
		if($date){
			return !empty($string) ? $string : '0000-00-00';
		}
		return !empty($string) ? $string : '';
	}

	function findAVG($ratingsList)
	{
		$rating = 0;$counter = 1;
		foreach($ratingsList as $key => $rate){
			if($key != 0){$counter++;}
			$rating += $rate->rating;
		}
		return number_format($rating/$counter,2);
	}

	function formInputTypeCheck($inputType)
	{
		$return = false;
		switch ($inputType){
            case 'radio' : $return = true;break;
            case 'checkbox': $return = true;break;
        }
        return $return;
	}

	function generateKeyForForm($string)
	{
		$key = '';
		for($i= 0; $i < strlen($string); $i++){
			if(!preg_match('/[^A-Za-z]+/', $string[$i])) {
				$key .= strtolower($string[$i]);
			}
		}
		return $key;
	}

	function randomGenerator()
	{
		return uniqid().''.date('ymdhis').''.uniqid();
	}

	function moneyFormat($amount)
	{
		$amount = preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $amount);
		return $amount;
	}

	// this function will work when user is Authenticated
	function urlPrefix()
	{
		$return = 'admin';
		switch(auth::user()->user_type){
			case 1: $return = 'admin';break;
			case 2: $return = 'supplier';break;
		}
		return $return;
	}

	function words($value, $words = 100, $end = '...')
    {
        return Str::words($value, $words, $end);
    }
    
    function sendMail($data , $template)
    {
		$toEmail = $data['to'];
		$toName = $data['name'];
		$sub = $data['subject'];
        Mail::send($template, compact('data'), function ($message) use ($toName, $toEmail, $sub) {
            $message->to($toEmail, $toName);
			$message->subject($sub);
            $message->from('support@seitcher.com', 'switcher');
        });
    }

    function sendTwilioMessage($to,$message)
    {
    	$sid = env('TWILIO_SID');
    	$authoriZation = env('TWILIO_AUTHORIZATION');
    	$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'https://api.twilio.com/2010-04-01/Accounts/'.$sid.'/Messages.json',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => array('From' => '+18509902391','To' => $to,'Body' => $message),
		  CURLOPT_HTTPHEADER => array(
		    'Authorization: Basic '.$authoriZation
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
    }

    function generateUniqueAlphaNumeric($length = 7)
    {
    	$random_string = '';
    	for($i = 0; $i < $length; $i++) {
    		$number = random_int(0, 36);
    		$character = base_convert($number, 10, 36);
    		$random_string .= $character;
    	}
    	return $random_string;
    }

    function getSumOfPoints($userPoints){
    	$totalPoint = 0;
    	foreach($userPoints as $getPoint){
    		$totalPoint += $getPoint->points;
    	}
    	return $totalPoint;
    }

 ?>