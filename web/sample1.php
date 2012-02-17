<?php
	$con = mysql_connect("localhost","trainee","trainee");
	mysql_select_db('test_nainit',$con);

	$sSql = "SELECT * FROM category ORDER BY category_id";
	$nRes = mysql_query($sSql);
?>
<table border='1'>
	<tr >
		<th>Category_id</th>
		<th>Category_name</th>
		<th>Category_parent</th>
	</tr>
<?php	
	while($nRec = mysql_fetch_array($nRes))
	{
		  echo "<tr>";
		  echo "<td>".$nRec['category_id']."</td>";
		  echo "<td>".$nRec['name']."</td>";
		  echo "<td>".$nRec['parent']."</td>";
		  echo "</tr>";
	}
?>
</table>
<?php 

	$sSql = "SELECT t1.name AS lev1, t2.name as lev2, t3.name as lev3, t4.name as lev4
	FROM category AS t1
	LEFT JOIN category AS t2 ON t2.parent = t1.category_id
	LEFT JOIN category AS t3 ON t3.parent = t2.category_id
	LEFT JOIN category AS t4 ON t4.parent = t3.category_id
	WHERE t1.name = 'ELECTRONICS'";

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr >
		<th>Level-1</th>
		<th>Level-2</th>
		<th>level-3</th>
		<th>level-4</th>
	</tr>
<?php	
	 while($nRec = mysql_fetch_array($nRes))
	 {
		  echo "<tr>";
		  echo "<td>".$nRec['lev1']."</td>";
		  echo "<td>".$nRec['lev2']."</td>";
		  echo "<td>".$nRec['lev3']."</td>";
		  echo "<td>".$nRec['lev4']."</td>";
		  echo "</tr>";
	}
?>
</table>
<?php
	$sSql = 'SELECT t1.name FROM
	category AS t1 LEFT JOIN category as t2
	ON t1.category_id = t2.parent
	WHERE t2.category_id IS NULL';

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr >
		<th>Name</th>
	</tr>
<?php	
	 while($nRec = mysql_fetch_array($nRes))
	 {
		  echo "<tr>";
		  echo "<td>".$nRec['name']."</td>";
		  echo "</tr>";
	}
?>
</table>
<?php
	$sSql="SELECT t1.name AS lev1, t2.name as lev2, t3.name as lev3, t4.name as lev4
	FROM category AS t1
	LEFT JOIN category AS t2 ON t2.parent = t1.category_id
	LEFT JOIN category AS t3 ON t3.parent = t2.category_id
	LEFT JOIN category AS t4 ON t4.parent = t3.category_id
	WHERE t1.name = 'ELECTRONICS' AND t4.name = 'FLASH'";

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr >
		<th>Level-1</th>
		<th>Level-2</th>
		<th>level-3</th>
		<th>level-4</th>
	</tr>
<?php	
	 while($nRec = mysql_fetch_array($nRes))
	 {
		  echo "<tr>";
		  echo "<td>".$nRec['lev1']."</td>";
		  echo "<td>".$nRec['lev2']."</td>";
		  echo "<td>".$nRec['lev3']."</td>";
		  echo "<td>".$nRec['lev4']."</td>";
		  echo "</tr>";
	}
?>
</table>
