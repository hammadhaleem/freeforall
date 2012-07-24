  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
	  <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i><?php echo $_SESSION['name'] ; ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="index.php?pid=2">Recent</a></li>
              <li class="divider"></li>
              <li><a href="index.php?pid=3">Favourites</a></li>
            </ul>
          </div>
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="index.php">MoviePie</a>
		  
          <div class="nav-collapse">
            <ul class="nav">
            <?php 
              if($i==2)
            	  echo ' <li class="active"><a href="index.php?pid=2">Suggestions </a></li>';
                   else
                  echo '<li><a href="index.php?pid=2">Suggestions</a></li>' ; 
             ?>
             
            <?php if(!isset($_GET['pid']))
             	  echo ' <li class="active"><a href="index.php">Welcome</a></li>';
                   else
                   echo '<li><a href="index.php">Welcome</a></li>' ; 
             ?>
             <?php if($i==1)
            	 echo ' <li class="active"><a href="index.php?pid=1">Watchlist</a></li>';
                   else
                   echo '<li><a href="index.php?pid=1">Watchlist</a></li>' ; 
             ?>
             
             <?php if($i==3)
            	  echo ' <li class="active"><a href="index.php?pid=3">Favourites</a></li>';
                   else
                   echo '<li><a href="index.php?pid=3">Favourites</a></li>' ; 
             ?>
             <?php if($i==4)
            	  echo ' <li class="active"><a href="index.php?pid=4">About</a></li>';
                   else
                   echo '<li><a href="index.php?pid=4">About</a></li>' ; 
             ?>
             <li><a href='#' onclick="FacebookInviteFriends();"> Invite Friends </a></li>
              
		</ul>
		        	
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div><div id="fb-root"></div>