<?php


if($_GET['d'] == 1 )
{
$watch="1";
$loop =$dbh->Query("select * from offline_access_users where user_id = '".$user."'");
$table =$dbh->FetchRow($loop);
$arr=explode(',',$table['watchlist']) ;
//d($arr) ;


 while($arr[$i])
	{
	if($arr[$i] == $_GET['mid'])
		{ 
			$arr[$i] = 1 ; 
		}
		$watch=$watch.",".$arr[$i];
		$i++ ;
		//d($watch); 
	}

$sql1="UPDATE `offline_access_users` SET watchlist='".$watch."' WHERE user_id='".$user."' " ;
//d($sql1);
$res=$dbh->Query($sql1);
}



?>