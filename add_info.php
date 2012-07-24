<?php 

//get user- if present, insert/update access_token for this user
$user = $facebook->getUser();

if($user){
	
	
	//get user data and access token
	try {
		$userData = $facebook->api('/me');
	} catch (FacebookApiException $e) {
		die("API call failed");
	}
	$accessToken = $facebook->getAccessToken(
	array(
               'scope'  => 'publish_actions,email,publish_stream,user_location,user_about_me,read_stream'
              )
	);
	
	
 
/* send old acccess tokens and fetch new long lasting ones */
$url = 'https://graph.facebook.com/oauth/access_token?client_id='.$fbconfig['appid'].'&client_secret='.$fbconfig['secret'].'&grant_type=fb_exchange_token&fb_exchange_token='.$accessToken.'' ;   
$html=getPage($url,'http://apps.facebook.com/moviepie', '30','5');
$piece1 = explode("access_token=", $html);
$piece= explode("&", $piece1[1]);
$accessToken=$piece[0];
$_SESSION['access']=$accessToken  ;
$_SESSION['user']=$user ; 
$_SESSION['appid']=$fbconfig['appid'];
$_SESSION['secret']=$fbconfig['secret'];



$result = mysql_query("
		SELECT
			*
		FROM
			offline_access_users
		WHERE
			user_id = '" . mysql_real_escape_string($userData['id']) . "'
	");
	$_SESSION['access']=$accessToken;
	
	
	if($result){
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		if(mysql_num_rows($result) > 1){
			mysql_query("
				DELETE FROM
					offline_access_users
				WHERE
					user_id='" . mysql_real_escape_string($userData['id']) . "' AND
					id != '" . $row['id'] . "'
			");
		}
	}
	
		if(!$row){
		mysql_query(
			"INSERT INTO 
				offline_access_users
			SET
				`user_id` = '" . mysql_real_escape_string($userData['id']) . "',
				`email` = '" . mysql_real_escape_string($userData['email']) . "',
				`name` = '" . mysql_real_escape_string($userData['name']) . "',
				`access_token` = '" . mysql_real_escape_string($accessToken) . "'
		");
	} else {
		mysql_query(
			"UPDATE 
				offline_access_users
			SET
				
				`email` = '" . mysql_real_escape_string($userData['email']) . "',
				`name` = '" . mysql_real_escape_string($userData['name']) . "',
				`access_token` = '" . mysql_real_escape_string($accessToken) . "'
			WHERE
				`user_id` = " . $user . "
		");
		
	}
	 $_SESSION['user']=$user;
        
           
}

//redirect to facebook page


if(isset($_GET['code'])){
	header("Location:https://apps.facebook.com/moviepie/" );
	exit;
}
//create authorising url
if(!$user){
	$loginUrl = $facebook->getLoginUrl(array(
		'canvas' => 1,
		'fbconnect' => 0,
		'scope'  => 'publish_actions,email,publish_stream,user_location,user_about_me,read_stream'
           ));
          
}

?>