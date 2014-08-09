<?php
    $fbconfig['appid' ] = "3xxxxxxxxxxxxxxxxxx5";
    $fbconfig['secret'] = "c34xxxxxxxxxxxxxxxxxxxxa4";

    $fbconfig['baseUrl']    =   "https://freeforall.herokuapp.com/";
    $fbconfig['appBaseUrl'] =   "http://apps.facebook.com/moviepie/";

   
    if (isset($_GET['code'])){
        header("Location: " . $fbconfig['appBaseUrl']);
        exit;
    }
    //~~
    
    //
    if (isset($_GET['request_ids'])){
        //user comes from invitation
        //track them if you need
    }
    
    $user            =   null; //facebook user uid
    try{
        include_once "facebook.php";
    }
    catch(Exception $o){
        echo '<pre>';
      //  print_r($o);
        echo '</pre>';
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));

    //Facebook Authentication part
    $user       = $facebook->getUser();
    // We may or may not have this data based 
    // on whether the user is logged in.
    // If we have a $user id here, it means we know 
    // the user is logged into
    // Facebook, but we don’t know if the access token is valid. An access
    // token is invalid if the user logged out of Facebook.
    
    $loginUrl   = $facebook->getLoginUrl(
            array(
               'scope'  => 'publish_actions,email,publish_stream,user_location,user_about_me,read_stream'
            )
    );

    if ($user) {
      try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $facebook->api('/me');
        $_SESSION['name'] = $user_profile['name'] ; 
      } catch (FacebookApiException $e) {
        //you should use error_log($e); instead of printing the info on browser
        error_log($e);  // d is a debug function defined at the end of this file
        $user = null;
      }
    }

    if (!$user) {
        echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
        exit;
    }
    
    //get user basic description
    $userInfo           = $facebook->api("/$user");

    function d($d){
        echo '<pre>';
        print_r($d);
        echo '</pre>';
    }
    $_SESSION['rotten_key']="uuacu746nquzs3f2679dcyv6" ; 
?>
