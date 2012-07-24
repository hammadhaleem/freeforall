<?php
    header("Content-type: text/css; charset: UTF-8");
	session_start();
	$mid = $_SESSION['mid'];
	$url="http://api.themoviedb.org/3/movie/".$mid."?api_key=4cff43a8a3eec60c17cb778d7d56214a";
	$referer=$url ; 
	$u=getPage($url, $referer, $timeout, $header);
	$j=json_decode($u);
?>
body 
{
background-image:url('http://cf2.imgobject.com/t/p/w500<?php echo $j->poster_path ; ?>');
background-color:#cccccc;
}