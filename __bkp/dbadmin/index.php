<?php

$link = mysql_connect("50.63.106.154","tellidbase1212","XenaDog12!!");
mysql_select_db("tellidbase1212",$link) or die(mysql_error());

?>

<script type="application/javascript">
function show_table()
{
	sql.show_table1.value="yes";
	sql.t1.value="select * from "+sql.table_name.value;
	sql.submit();
}
</script>

<form name="sql" method="post" >
	<input type="hidden" name="show_table1">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
	<tr>
		<td width="13%" height="135">Enter Query:</td>
		<td width="55%"><textarea name="t1" rows="7" cols="70"><?=stripslashes($_POST[t1])?></textarea></td>
		<td width="32%">
			<table cellpadding="0" cellspacing="0" border="0" width="80%" align="center">
				<tr>
					<td align="center"><b>Tables</b></td>
				</tr>

				<tr>
					<td align="center">
						<select name="table_name" onChange="show_table();">
							<option value="">Select One</option>
							<?php 
								$sql_show_all="show tables";
								$rs_show_all=mysql_query($sql_show_all);
                            	while($rec_show_all=mysql_fetch_array($rs_show_all)){
							?>
							<option value="<?=$rec_show_all[0]?>" <?=($rec_show_all[0] == $_POST['table_name'])?'SELECTED':'';?>><?=$rec_show_all[0]?></option>
							<?
							}
							mysql_free_result($rs_show_all);
							?>
						</select>
						<br /><br />
						<input type="checkbox" name="chk" value="1">Create table syntax
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
    	<td></td>
        <td align="left" height="50"><input type="submit" value="Submit" name="Submit"></td>
	</tr>
	</table>
</form>
<br />

<?php
if(($_POST[Submit]) ||($_POST[show_table1]=="yes"))
{
	$arr=split(";",stripslashes($_POST['t1']));
	for($i=0;$i<count($arr);$i++)
	{
		$rs=mysql_query($arr[$i]);
	}

	//$affected_rows= mysql_affected_rows();
	if($_POST['table_name'] != '' && $_POST['chk'] == 1)
	{
		$newSql = "SHOW CREATE TABLE  " . $_POST['table_name'] . "";
		$newRs = mysql_query($newSql) or die(mysql_error());
		$newRec = mysql_fetch_array($newRs);
		echo  str_replace('`','',stripslashes($newRec[1])) . "<br><br>" ;
	}

	if($rs)
	{ 
		if ($rs>1)	
			show_table($rs);
		else 
			up_del($rs);
	}
	else
	{ 
		echo "<b>Please write a proper Query.</b>";
		echo "<br><br><b>Error : ".mysql_error()."</b>";
	}
}

function show_table($rs)
{
	$kk=mysql_num_fields($rs);
?>

	<table cellpadding="3" cellspacing="3" border="1" width="90%">
		<tr bgcolor="#99FF99" >
<?php	for( $i=0;$i<$kk;$i++) echo "<td><b><font color='#000000' size='-1' face='Courier New, Courier, mono'>".mysql_field_name($rs, $i)."</font></b></td>";	?>

		</tr><tr></tr>

<?php if (mysql_num_rows($rs)>0)
{
	$i=0;
	while($rec=mysql_fetch_array($rs))
	{
		echo "<tr>";
		for($i=0;$i<$kk;$i++)
		{
			echo "<td valign='top'><font color='#000000' size='-1' face='Courier New, Courier, mono'>".stripslashes($rec[$i])."&nbsp;</td>";
		}
		echo "</tr>";
	}
} 
?>
</table>

<?php
}

function up_del($rs)
{
	echo "<b> Number Of Affected Rows==". mysql_affected_rows()."</b>";
}