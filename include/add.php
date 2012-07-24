<?php 
		
/*for watch list */
		if(isset($_GET['w']))
		{ 
		  if($_GET['w']==1)
		    	{
		    	
		$mid=$_GET['mid'];
		include_once  "config/config.php";
		$user = $facebook->getUser();
		$sql="SELECT * FROM `offline_access_users` WHERE `user_id`='".$user."' " ; 
		$res=$dbh->Query($sql);
		$row=$dbh->FetchRow($res);
		$watchlist=$row['watchlist'];
		if($row['watchlist']=="" ||$row['watchlist'] == 0 )
			{
		//	echo "watch list empty start watching<br/> " ;
			 $watchlist = $_GET['mid'] ;
			}
			else
			{
			$watchlist=$watchlist.",".$_GET['mid'] ; 
			$mylist = explode(",",$watchlist);
			
			
			}
		//	echo "<br/>Your watchlist : ".$watchlist."<br/>" ; 
		$sql="UPDATE `offline_access_users` SET watchlist='".$watchlist."' WHERE user_id='".$user."' " ; 
		$res=$dbh->Query($sql);
					// echo "<br/>Updated "; 
					 }
					 }
 /*Ends --------for favourites ----Ends */
			 
			 
/*for Favourite list */
			if(isset($_GET['f']))
			{   if($_GET['f']==1)
			    	{
			    	
			$mid=$_GET['mid'];
			include_once  "config/config.php";
			$user = $facebook->getUser();
			$sql="SELECT * FROM `offline_access_users` WHERE `user_id`='".$user."' " ; 
			$res=$dbh->Query($sql);
			$row=$dbh->FetchRow($res);
			$favor=$row['favourite'];
			if($row['favourite']=="" ||$row['favourite'] == 0 )
				{
				//echo "watch list empty start watching<br/> " ;
				 $favor = $_GET['mid'] ;
				}
				else
				{
				//echo "added to watchlist " ; 
				$favor=$favor.",".$_GET['mid'] ; 
				}
				
				
				// echo "<br/>Your watchlist : ".$favor."<br/>" ; 
			$sql="UPDATE `offline_access_users` SET favourite='".$favor."' WHERE user_id='".$user."' " ; 
			$res=$dbh->Query($sql);
						// echo "<br/>Updated "; 
						 }
						 }
						 
 /*Ends --------Favourites----Ends */
						 
			 
			 
			 
?>