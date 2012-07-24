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
           // d($o);
        }
    }
    if (isset($_GET['mid']))
    {
    if($_GET['w']==1)
    	{
    	  include_once "include/add.php"; 
    	}
    if($_GET['f']==1)
    	{
    	  include_once "include/add.php"; 
    	}
    	
     require "template/header.php";
     require "template/nav.php";
     require "template/movies.php" ;
     require "template/footer.php";
     }
     else
     {
     echo '<script type="text/javascript">window.location = "http://apps.facebook.com/moviepie/"</script> ' ;
     }
?>