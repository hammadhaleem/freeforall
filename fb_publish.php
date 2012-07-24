  <?php 
  
	//echo "hello"; 
         
		             		/* if user not allow to upload */
		if(!isset($_SESSION['published']))
				{
					$msg=array();
					$msg['access_token']=$_SESSION['access'];
	                $msg['url']="http://apps.facebook.com/moviepie/";
	                $msg['message']="I was using movie-pie a facebook movie database ! , have a look its intresting  ";
					d($msg); 
		             			try {
								    $facebook->api('me/feed', 'post', $msg);
									$_SESSION['published']=1;
									}
		             				catch (FacebookApiException $e)
		             				{
		             					d($e) ;
		             					continue ;
		            				}
		     
				}
				
						?>