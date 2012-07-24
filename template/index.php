<div class="container">
	<div class="page-header">
			<center style="padding-top:20px;">
			<form action="#" id="search_box">
			<div class="wrapper">
			<input type="text" id="sample" name="mid" placeholder="Movie Search  " />
			<button type="submit" class="search_btn"><img src="search_icon.png" title="Search" /></button>
			</div>
		        </form>
		        </center>
	 </div>
      
      <div class="row">
        <div class="span4">
        <div class="box">
          <h4>Box office</h4>
           <div class="demo1">
           	<div style="position: absolute; margin: 0px; top: 0px; ">
           		
<?php 
		$url="api.rottentomatoes.com/api/public/v1.0/lists/movies/box_office.json?limit=10&country=us&apikey=uuacu746nquzs3f2679dcyv6";
		$referer="http://apps.facebook.com/moviepie/" ; 
		$u=getPage($url, $referer, $timeout, $header);
		$j=json_decode($u);
		foreach ( $j->movies as $data)
		{
				echo "<div>";
				echo "<a href='movies.php?mid=".$data->id."'>";
				d($data->title) ; 
				echo "<img src=".$data->posters->thumbnail.">"; 
				echo "</a></div>";  
		}
?>

				</div>
				</div>
			</div>
		</div>
        <div class="span4">
        <div class="box">
          <h4>In Theaters</h4>
         <div class="demo2">
				<div style="position: absolute; margin: 0px; top: 0px; ">
<?php 
		$url="http://api.themoviedb.org/3/movie/now-playing?api_key=4cff43a8a3eec60c17cb778d7d56214a";
		$referer="http://apps.facebook.com/moviepie/" ; 
		$u=getPage($url, $referer, $timeout, $header);
		$j=json_decode($u);
		foreach ( $j->results as $data)
		{
				echo "<div>";
				echo "<a href='movies.php?mid=".$data->id."'>";
				d($data->title) ; 
				echo '<img src="http://cf2.imgobject.com/t/p/w45'.$data->poster_path.'">'; 
				echo "</a></div>"; 
		}
?>

				</div>
				</div>
			</div>
	</div> 
        <div class="span4">
        <div class="box">
          <h4>Upcoming Movies</h4>
     
		 <div class="demo3">
					<div style="position: absolute; margin: 0px; top: 0px; ">
					    <?php 
						include "include/upcoming.php"; 
						?>
						
				<!-- end row 1 -->
      <div class="row">
        
      </div><!-- end row 1 -->
<hr>
     Recently reviewed 
     <ul id="mycarousel" class="jcarousel-skin-tango">
     <?php
     foreach ( $j->movies as $data)
		{
				echo "<li>";
				echo "<a href='movies.php?mid=".$data->id."'>";
				echo "<img src=".$data->posters->thumbnail." width='75' >"; 
				echo "</a></li>"; 
		}
		?>
	 </ul> <hr>
   
       <hr>