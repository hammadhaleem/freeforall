<?php 



include  "include/del.php";


$loop =$dbh->Query("select * from offline_access_users where user_id = '".$user."'");

$table =$dbh->FetchRow($loop);
$arr=explode(',',$table['watchlist']) ;




/*
$arr1 = array_unique($arr);
d($arr1);
*/

/*way two */
$i=0; 
$j=0; 
$new_array=array() ;
$sql="SELECT * FROM  `movie` WHERE `rot_id`=  " ;
$rot=" or `rot_id` = ";
while($arr[$i])
{
	
	$new_arr[$j]=$arr[$i] ; 
	$j++ ; 
	$count=0;
	for($k=0;$k<=$j;$k++)
	{
		if($new_arr[$k]==$arr[$i] )
		{
		$count++ ; 
		}
		if($count >1)
		{
		$new_arr[$j]=0; 
		$j=$j-1;
		break ;
		}
	}
	$i++;
	
}
//d($new_arr);
 
$k=$k-1;
$watch="1";
for($i=0;$i<$k;$i++)
{
$watch=$watch.",".$new_arr[$i];
$sql=$sql.$new_arr[$i] ;
$sql=$sql.$rot ; 
}
$sql=$sql."0" ; 
/*update watchlist */





$loop =$dbh->Query($sql);
$count=0;
echo "<table>"; 
while($table =$dbh->FetchRow($loop))
{	
	$j=$count+1;
	echo "<tr><td>".$j.". ";
	print_r('&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="?d=1&pid=1&mid='.$table['rot_id'].'">Delete ( - ) </a> &nbsp;&nbsp;&nbsp;&nbsp; ');
	print_r('<b>Name:</b><a href="http://saint.nseasy.com/~engineer/apps/movies/movies.php?mid='.$table['rot_id'].'">'.$table['name'].'</a></td><td>');
	
	echo "</td></tr>";
	$count++;
}
echo "</table>" ; 
if($count ==0)
{
        echo "";
	print_r('No movies in watchlist .. start watching ');
	echo "";
	}
	
$sql1="UPDATE `offline_access_users` SET watchlist='".$watch."' WHERE user_id='".$user."' " ; 
//d($sql1);
$res=$dbh->Query($sql1);

if($_GET['d'] == 1 )
{

}
?>							
