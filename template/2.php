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
							 ?>						 
					</ul>
					</div>
				</div><!-- .span3 -->
				
				<div class="span9">				
					<div class="tab-content">
						<div class="tab-pane active" id="tabs-basic">
		<?php
			include "include/suggested.php"; 
		?>					
						        
						
			            </div><!-- .span7 -->
			</div><!-- .tabbable -->
	        </div><!-- .row-fluid -->
	    </div>
	</div>


      <hr />

				