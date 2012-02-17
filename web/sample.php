<?php
	$con = mysql_connect("localhost","trainee","trainee");
	mysql_select_db('test_nainit',$con);

	$sSql = "SELECT * FROM nested_category ORDER BY category_id";
	$nRes = mysql_query($sSql);
?>
<table border='1'>
	<tr>
		<th>Category_Id</th>
		<th>Category_Name</th>
		<th>Category_Left</th>
		<th>Category_Right</th>
	</tr>
<?php	
	while($nRec = mysql_fetch_array($nRes))
	{
		echo "<tr>";
		echo "<td>".$nRec['category_id']."</td>";
		echo "<td>".$nRec['name']."</td>";
		echo "<td>".$nRec['lft']."</td>";
		echo "<td>".$nRec['rgt']."</td>";
		echo "</tr>";
	}
?>
</table>
<?php
	$sSql = "SELECT node.name
	FROM nested_category AS node,
	nested_category AS parent
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
	AND parent.name = 'ELECTRONICS'
	ORDER BY node.lft";

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr>
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
	$sSql="SELECT name
	FROM nested_category
	WHERE rgt = lft + 1";

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr>
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
	$sSql ="SELECT parent.name
	FROM nested_category AS node,
	nested_category AS parent
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
	AND node.name = 'FLASH'
	ORDER BY parent.lft";

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr>
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
	$sSql ="SELECT node.name, (COUNT(parent.name) - 1) AS depth
	FROM nested_category AS node,
	nested_category AS parent
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
	GROUP BY node.name
	ORDER BY node.lft";

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr>
		<th>Name</th>
		<th>Depth</th>
	</tr>
<?php	
	while($nRec = mysql_fetch_array($nRes))
	{
		echo "<tr>";
		echo "<td>".$nRec['name']."</td>";
		echo "<td>".$nRec['depth']."</td>";
		echo "</tr>";
	}
?>
</table>

<?php
	$sSql ="SELECT CONCAT( REPEAT(' ', COUNT(parent.name) - 1), node.name) AS name
	FROM nested_category AS node,
	nested_category AS parent
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
	GROUP BY node.name
	ORDER BY node.lft";

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr>
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
	$sSql ="SELECT node.name, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
	FROM nested_category AS node,
		nested_category AS parent,
		nested_category AS sub_parent,
		(
			SELECT node.name, (COUNT(parent.name) - 1) AS depth
			FROM nested_category AS node,
			nested_category AS parent
			WHERE node.lft BETWEEN parent.lft AND parent.rgt
			AND node.name = 'PORTABLE ELECTRONICS'
			GROUP BY node.name
			ORDER BY node.lft
		)AS sub_tree
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
		AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
		AND sub_parent.name = sub_tree.name
	GROUP BY node.name
	ORDER BY node.lft";

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr>
		<th>Name</th>
		<th>Depth</th>
	</tr>
<?php	
	while($nRec = mysql_fetch_array($nRes))
	{
		echo "<tr>";
		echo "<td>".$nRec['name']."</td>";
		echo "<td>".$nRec['depth']."</td>";
		echo "</tr>";
	}
?>
</table>

<?php
	$sSql ="SELECT node.name, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
	FROM nested_category AS node,
		nested_category AS parent,
		nested_category AS sub_parent,
		(
			SELECT node.name, (COUNT(parent.name) - 1) AS depth
			FROM nested_category AS node,
			nested_category AS parent
			WHERE node.lft BETWEEN parent.lft AND parent.rgt
			AND node.name = 'PORTABLE ELECTRONICS'
			GROUP BY node.name
			ORDER BY node.lft
		)AS sub_tree
	WHERE node.lft BETWEEN parent.lft AND parent.rgt
		AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
		AND sub_parent.name = sub_tree.name
	GROUP BY node.name
	HAVING depth <= 1
	ORDER BY node.lft";

	$nRes = mysql_query($sSql);
?>
<br>
<table border='1'>
	<tr>
		<th>Name</th>
		<th>Depth</th>
	</tr>
<?php	
	while($nRec = mysql_fetch_array($nRes))
	{
		echo "<tr>";
		echo "<td>".$nRec['name']."</td>";
		echo "<td>".$nRec['depth']."</td>";
		echo "</tr>";
	}
?>
</table>
