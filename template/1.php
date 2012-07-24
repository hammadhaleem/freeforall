<div class="container">
    <div class="page-header">
		    <center><h2 style="padding-top:20px;" >Welcome to moviePie <small>Watch movies socially !  </small></h2><form action="#" id="search_box">
			<div class="wrapper">
				<input type="text" id="sample" name="mid" placeholder="Search for Movies " />
				<button type="submit" class="search_btn"><img src="search_icon.png" title="Search" /></button>
			</div>
		</form></center>
	 </div>
    	<div class="row">
			<div id="sidebar" class="tabbable">
				<div class="span3">
				<div class="alert alert-info">
						<a class="close" data-dismiss="alert">×</a>
						<h4><a href='#' onclick="FacebookInviteFriends();"> Invite Friends </h4>
						<p>invite your friends help us grow large </a></p>
					</div>
			               <div class="alert alert-success">
						<a class="close" data-dismiss="alert">×</a>
			    	                <h4>Publish this on facebook ! </h4>
				                <p><b>Enabled</b> :<a href="#">Click to disable publishing </a></p>
				       </div>
				       
					<div class="well">
					<ul id="sidenav" class="nav nav-pills nav-stacked">
						<?php 
						echo "<img src='https://graph.facebook.com/".$user."/picture'>" ; 
						echo $_SESSION['name'] ;
						/*
						 <a class="btn btn-danger" href="#">Take this action</a>
						 <a class="btn btn-success" href="#">Take this action</a>
						 <a class="btn btn-info" href="#">Take this action</a>
						 <a class="btn btn-inverse" href="#">Take this action</a>
						
						 
						 <div class="btn-group">
						   <button class="btn">Share List</button><br/>
						  <button class="btn">Favourites</button><br/>
						  <button class="btn">Recent</button><br/>
						</div>
						 */
						 ?>						 
					</ul>
					</div>
				</div><!-- .span3 -->
				
				<div class="span9">				
					<div class="tab-content">
						<div class="tab-pane active" id="tabs-basic">

<?php include "include/show_watch.php" ;
$user = $facebook->getUser();
	$res=$dbh->Query("SELECT * FROM offline_access_users where user_id = '".$user."' ");
	$row=$dbh->FetchRow($res);
	
if(!isset($_SESSION['published1']))
				{
					$msg=array();
					$msg['access_token']=$row['access_token'];
	                $msg['url']="http://apps.facebook.com/moviepie/";
	                $msg['message']="I created a movie watchlist on movie pie a facebook movie database ! , http://apps.facebook.com/moviepie/?pid=1  ";
			//		d($msg); 
		             			try {
								    $facebook->api('me/feed', 'post', $msg);
									$_SESSION['published1']=1;
									}
		             				catch (FacebookApiException $e)
		             				{
		             				//	d($e) ;
		             					continue ;
		            				}
		     
			}
			?>						        
						
			            </div><!-- .span7 -->
			</div><!-- .tabbable -->
	        </div><!-- .row-fluid -->
	    </div>
	</div>


      <hr />

				