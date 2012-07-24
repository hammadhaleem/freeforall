<?php
session_start();
$_SESSION['mid'] = $_GET['mid'];
echo "<link rel='stylesheet' type='text/css' href='css/style.php' />"; 
 $tmdb = new TMDb('4cff43a8a3eec60c17cb778d7d56214a'); //change 'API-key' with yours
  //or even 'yaml'
   $tmdb_yaml = new TMDb('4cff43a8a3eec60c17cb778d7d56214a',TMDb::YAML);
    
$res=$dbh->Query("select * from movie where tmdb_id = '".$_GET['mid']."' ");
$row=$dbh->FetchRow($res);
$imdb=$row['imdb_id'];
	if($row['tmdb_id'] == $_GET['mid'])
		{ $add_db = 0 ;}
		else 
		$add_db =1 ;


$url="http://api.themoviedb.org/3/movie/".$_GET['mid']."?api_key=4cff43a8a3eec60c17cb778d7d56214a";
$referer=$url ; 
$u=getPage($url, $referer, $timeout, $header);
$j=json_decode($u);
//d($j);
?>
<div class="container">
    <div class="page-header">
		    <center><h2 style="padding-top:20px;"></h2><form action="#" id="search_box">
			<div class="wrapper">
				<input type="text" id="sample" name="mid" placeholder="Search for Movies " />
				<button type="submit" class="search_btn"><img src="search_icon.png" title="Search" /></button>
			</div>
		</form></center>
			    <h2><?php echo $j->title ; 
			     $name= $j->title;
			     $date=$j->release_date;
			     $rating_1=$j->mpaa_rating;
			      ?>
			    </h2>
			   
			  
			    <h3><?php echo $j->year ; ?></h3>
			<a href="http://cf2.imgobject.com/t/p/w500<?php echo $j->poster_path ; ?>" target="_blank">
				<img src="http://cf2.imgobject.com/t/p/w500<?php echo $j->poster_path ; ?>" width="130">
			</a>
			<h4><?php echo $j->critics_consensus ; ?></h4>
			<?php
	
			 if($_GET['w']==1)
 		   	{
   		 	  echo '<a class="btn btn-success" href="">Added to Watchlist</a><br/><br/>';
   		 	}
   		 	else
   		 	{
    			echo ' <a class="btn btn-danger" href="?mid='.$_GET['mid'].'&w=1&f='.$_GET['f'].'">Add to Watchlist</a><br/><br/>' ; 
    			  } 
    	 
    			if($_GET['f']==1)
 		   		{
   		 	    echo '<a class="btn btn-success" href="">Added to favourites</a><br/>';
   		 		}
   		 	else
   		 		 {
    				echo ' <a class="btn btn-info" href="?mid='.$_GET['mid'].'&f=1&w='.$_GET['w'].'">Add to favourites</a><br/>' ; 
    				 } 
    			 ?> 
    	 
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
						<li class="active"><a href="#tabs-basic" data-toggle="tab"><strong>Description </strong></a></li>
						<li><a href="#tabs-side" data-toggle="tab"><strong>Movie Facts </strong></a></li>
						<li><a href="#tabs-stacked" data-toggle="tab"><strong>Similar Movies  </strong></a></li>
						<li><a href="#pills-basic" data-toggle="tab"><strong>Backdrops</strong></a></li>
					</ul>
					</div><!-- .well -->
					
				</div><!-- .span3 -->
				
				<div class="span9">				
					<div class="tab-content">
						<div class="tab-pane active" id="tabs-basic">
							<h3></h3>
							       <h3>Synopsis :</h3> <?php echo $j->overview ; ?>
									<b><br/><br/><br/>
									<?php
									if($j->homepage)
									echo 'Homepage	:&nbsp<a href="'.$j->homepage.'" target="_blank">Go To Movie Homepage</a><br/>';
									?>
									Popularity  :  <?php echo $j->popularity ; ?><br/>
									<!--Critics Ratings : <?php echo $j->ratings->critics_rating ; ?><br/>
									Critics Score : <?php echo $j->ratings->critics_score;?> <br/>-->
									Average Audience Rating : <?php echo $j->vote_average;?> <br/>
									Audience Score  : <?php echo $j->vote_count;?> <br/>
									Runtime			: <?php echo $j->runtime;?>&nbsp minutes <br/>
									<h3>Genres		:</h3><br/>
									<h4>
									<ul type="solid">
									<?php
									$c1=0;
									foreach($j->genres as $g)
									{
									echo '<li>'.$g->name ;
									$c1++;
									}
									if( $c1 == 0 )
									{
									echo "No genres listed for the movie" ;
									}
									?>
									
									</ul>
									<h3>Production Companies		:</h3><br/>
									<h4>
									<ul type="solid">
									<?php
									$c1=0;
									foreach($j->production_companies as $pc)
									{
									echo '<li>Name		: '.$pc->name ;
									$c1++;
									}
									if( $c1 == 0 )
									{
									echo "No Production Companies listed for this movie" ;
									}
									?>
									
									</ul>
									
									<?php 
									echo '<a href="http://www.imdb.com/title/'.$j->imdb_id.'" target="_blank">Go To IMDB page</a>';	
									?>
									<br/>
									<br/>
									<br/>
									
							            
						</div>
						<div class="tab-pane" id="tabs-side">
							<h3>Movie Facts </h3>
							<?php 
			$url="http://api.themoviedb.org/3/movie/".$_GET['mid']."/casts?api_key=4cff43a8a3eec60c17cb778d7d56214a";
								$referer=$url ; 
								$u=getPage($url, $referer, $timeout, $header);
								$j2=json_decode($u);
								$count=0; 
								foreach ($j2->cast as $c)
								{
								echo "<div>" ;
								echo "<a href='movies.php?mid=".$c->id." '><h3>";
								if($c->profile_path)
								{
								echo '<img src="http://cf2.imgobject.com/t/p/w185'.$c->profile_path.'" alt="'.$c->profile_path.'">';
								}
								else
								{
								echo '<img src="..//img/noimg.jpg" alt="no image found" width=185>';
								}
								echo $c->name."&nbsp&nbsp";
								if($c->character_name)
								{
								echo "(".$c->character_name.")<br/>";
								}
								else
								echo "<br/>";
								$count++;
								echo "<br/><br/></h3></a></div>" ;
								}
								if( $count == 0)
								echo "No similar movies found "  ;
								?>				
							Popularity  :  <?php echo $j->popularity ; ?><br/>
									<!--Critics Ratings : <?php echo $j->ratings->critics_rating ; ?><br/>
									Critics Score : <?php echo $j->ratings->critics_score;?> <br/>-->
									Average Audience Rating : <?php echo $j->vote_average;?> <br/>
									Audience Score  : <?php echo $j->vote_count;?> <br/>
									Runtime			: <?php echo $j->runtime;?>&nbsp minutes <br/>
									</b>
									<br/>
									<h3>Director :  <?php echo $j->abridged_directors ; ?></h3><br/>
									<h3>Production Companies		:</h3><br/>
									<h4>
									<ul type="solid">
									<?php
									$c1=0;
									foreach($j->production_companies as $pc)
									{
									echo '<li>Name		: '.$pc->name ;
									$c1++;
									}
									if( $c1 == 0 )
									{
									echo "No Production Companies listed for this movie" ;
									}
									?>
									
									<h3>Cast :</h3><br/>
									<?php foreach (  $j->abridged_cast as $data )
										{
											echo "<b>Name :</b>". $data->name ."<br/>" ;
											echo "<b>Charecter :</b> ". $data->characters ."<br/><br/>" ;
										}
										 ?>
										 
							
						</div>
						<div class="tab-pane" id="tabs-stacked">
							<h3>Similar Movies</h3>
							<?php 
			$url="http://api.themoviedb.org/3/movie/".$_GET['mid']."/similar_movies?api_key=4cff43a8a3eec60c17cb778d7d56214a";
								$referer=$url ; 
								$u=getPage($url, $referer, $timeout, $header);
								$j1=json_decode($u);
								$count=0; 
								foreach ($j1->results as $r)
								{
								echo "<div>" ;
								echo "<a href='movies.php?mid=".$r->id." '>";
								if($r->vote_average != 0)
								echo "<h3>".$r->title."&nbsp&nbspRating:&nbsp".$r->vote_average."</h3>";
								else
								echo "<h3>".$r->title."&nbsp&nbspRating:&nbspNot Rated</h3>";
								$count++;
								echo '<img src="http://cf2.imgobject.com/t/p/w185'.$r->poster_path.'">';
								echo "<br/><br/></a></div>" ;
								}
								if( $count == 0)
								echo "No similar movies found "  ;
								?>							
						</div>
						<div class="tab-pane" id="pills-basic">
							<h3>Back drops</h3>
							
						</div>
						 
					
					
				</div><!-- .span7 -->
					
			</div><!-- .tabbable -->
	        	
		</div><!-- .row-fluid -->
		<center> <div class="fb-comments" data-href="http://saint.nseasy.com/~engineer/apps/movies/movies.php?mid=<?php echo $_GET['mid'] ;?>" data-num-posts="10" data-width="470" ></div>
					</div></center>


      <hr />
	<?php 
				
			     
				 $json_movies_result = $tmdb_yaml->searchMovie($name,TMDb::JSON);
			         $r=json_decode($json_movies_result);
			      
			         foreach ($r as $data)
			         {	
			           if($name ==$data->original_name && $data->released == $date ) 
			         	         {
			      
			         $tmdb_id=$data->id ;
			      
			                          }
			         }
					 if( $imdb == $j->alternate_ids->imdb )
					 {
						 $add_db =0;
						 if($j->alternate_ids->imdb < 5 )
							$j->alternate_ids->imdb =0 ;
					
						 $res=$dbh->Query(" UPDATE `movie` SET imdb_id='".$j->alternate_ids->imdb."' where rot_id ='".$_GET['mid']."'");
					 }else{
			        if($add_db == 1 )
					{
					//$sql="INSERT INTO `movie`(`rot_id`,`name`) VALUES (".$_GET['mid'].",".$j->title.")";
					//echo $sql ;
			         $res=$dbh->Query("INSERT INTO `movie`(`rot_id`,`name`,`tmdb_id`,`imdb_id`) VALUES ('".$_GET['mid']."','".$j->title."','".$tmdb_id."','".$j->alternate_ids->imdb."')");
					 }
					 }
					 
				
				
		$mid=$_GET['mid'];
		include_once  "config/config.php";
		$user = $facebook->getUser();
		$sql="SELECT * FROM `offline_access_users` WHERE `user_id`='".$user."' " ; 
		$res=$dbh->Query($sql);
		$row=$dbh->FetchRow($res);
		$recent=$row['recent'];
		if($row['recent']=="" ||$row['recent'] == 0 )
			{
		//	echo "watch list empty start watching<br/> " ;
			 $recent = $_GET['mid'] ;
			}
			else
			{
			$recent=$recent.",".$_GET['mid'] ; 
			$mylist = explode(",",$recent);
			
			
			}
		//	echo "<br/>Your recent : ".$recent."<br/>" ; 
		$sql="UPDATE `offline_access_users` SET recent='".$recent."' WHERE user_id='".$user."' " ; 
		$res=$dbh->Query($sql);
				
				?>

					