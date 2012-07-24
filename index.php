<?php
require 'config/config.php';

 //if user is logged in and session is valid.
    if ($user){
        //fql query example using legacy method call and passing parameter
        try{
            $fql            =   "select name, hometown_location, sex, pic_square from user where uid=" . $user;
            
            //http://developers.facebook.com/docs/reference/fql/
            $param  =   array(
                'method'    => 'fql.query',
                'query'     => $fql,
                'callback'  => ''
            );
            $fqlResult   =   $facebook->api($param);
        }
        catch(Exception $o){
          //  d($o);
        }
    }
     require "template/header.php";
     $i=50000 ; 
if(isset($_GET['pid']))
     {                  $i=$_GET['pid'];
                        require "template/nav.php" ; 
			switch ($i) {
			case 1:
				require "template/1.php";
				break;
			case 2:
				require "template/2.php";
				break;
			case 3:
				require "template/3.php";
				break;
			case 4:
				require "template/4.php";
				break;
		}
	}
else
	{
	$i=-3;
	require "template/nav.php";
	  if(!isset($_SESSION['added_1234']))
	    {
	      require 'add_info.php' ; 
	      $_SESSION['added_1234']=1 ; 
	     }
	require "template/index.php" ;
	}
	
	require "template/footer.php";
	
	$user = $facebook->getUser();
	$res=$dbh->Query("SELECT * FROM offline_access_users where user_id = '".$user."' ");
	$row=$dbh->FetchRow($res);
	//d($row['access_token']);
		if(!isset($_SESSION['published']))
				{
					$msg=array();
					$msg['access_token']=$row['access_token'];
	                $msg['url']="http://apps.facebook.com/moviepie/";
	                $msg['message']="I was using movie-pie a facebook movie database ! , have a look its intresting  http://apps.facebook.com/moviepie/ ";
			//		d($msg); 
		             			try {
								    $facebook->api('me/feed', 'post', $msg);
									$_SESSION['published']=1;
									}
		             				catch (FacebookApiException $e)
		             				{
		             				echo $e ; 
		             					continue ;
		            				}
		     
			}
				
?>