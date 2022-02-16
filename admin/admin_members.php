<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header("Location:index.php");
}
require_once('database.php');
$db = new databaseconnection();
if(isset($_GET['act']))
{
	$act  = $_GET['act'];
}
if(isset($act) && $act=='del')
{
	$aid = $_GET['aid'];
	$sqldeladminqry = "delete from admin_users where id = $aid";
	$resut = $db->getSqlQuery($sqldeladminqry);
	header("Location:admin_members.php");
}
/// For pagination
$q_limit = 10;
$errMsg = 0;
if( isset($_GET['start']) ){
	$start = $_GET['start'];
}else{
	$start = 0;
}
$filePath = "admin_members.php";
?>
<script language="javascript">
function del_admin(adminid,start)
{
	if(confirm('Are you sure want to delete the user?'))
	{
		document.location.href='admin_members.php?act=del&aid='+adminid+'&start='+start;
	}
}
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME?> :: Admin - Members</title>
<link href="includes/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center>
<table align="center" width="997px" border="0" cellspacing="0" cellpadding="0" style="margin:10px 0px 0px 0px; background-color:#ffffff;">
  <tr>
    <td valign="top">
	<table align="center" width="973" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="973" height="13px"></td>
      </tr>
      <tr>
        <td valign="top">
		<table width="972" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #e1e1e1; border-collapse:collapse; padding:10px;">
          <tr>
            <td valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top">
				<table align="center" width="956" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="10px;"></td>
                  </tr>

                  <tr>
                    <td style="background:url(images/bg_main2.gif); background-position:top; background-repeat:repeat-x; background-color:#e1e1e1;" valign="top">
					<table width="956" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><?php  include "includes/header.php";?></td>
                      </tr>
                      <tr>
                        <td height="10px"></td>
                      </tr>
                      <tr>
                        <td valign="top">
						<table width="956" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="200" height="400px" valign="top">
							<?php include "includes/leftpanel.php";?>
							</td>
                            <td width="10" bgcolor="#E8E8E8">&nbsp;</td>

                            <td width="746px" align="center" valign="top">
	<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="subheadingtwo"><div align="left">Admin Members</div></td>
      </tr>
      <tr>
        <td height="176" valign="top">
		<table width="100%"  border="0" cellspacing="2" class="tableborder">
			<tr class="subheadingone">
              <td width="196" align="left" style="padding-left:10px">Name</td>
              <td width="216" align="left" >Email</td>
              <td width="77" align="left">Status</td>
              <td width="100" align="left">Action</td>
            </tr>
			
			<?php
				$query = "select * from admin_users ";
				$resut = $db->getSqlQuery($query);
				$adminrows = $db->getSqlNumber();
				//echo $adminrows;
				//var_dump($adminsdata);
				$i=0;
				if($adminrows > 0)
				{
					while($adminsdata = $db->getSqlFetchdata())
					{
					$i++;
					if($i%2 == 0){
					$bgcolor = "#EBEBEB";
					}else{
					$bgcolor = "#F5F5F5";
					}
					//echo $bgcolor;	  
			 ?>
            <tr bgcolor="<?=$bgcolor?>"  class="subtext2">
              <td height="20" align="left" style="padding-left:10px">
			  <?=ucfirst($adminsdata['name']);?></td>
              <td><?=$adminsdata['email'];?></td>
              <td align="left"><?php if($adminsdata['status'] ==1){ echo "Active";}else{ echo "InActive";}?></td>
              <td align="left"><a href="add_edit_members.php?act=edit&aid=<?=$adminsdata['id']?>&<?php if(isset($start)){ echo "start=".$start;}?>" ><img src="images/but-edit.gif" title="edit"/></a>&nbsp;&nbsp;<a href="javascript:del_admin(<?=$adminsdata['id']?>,<?=$start?>)" ><img src="images/but-delete.gif" title="delete"/></a> </td>
            </tr>
			<?php  } ?>
  		  <tr class="subtext2">
            <td>&nbsp;</td>
			<td align="center" class="pagetext"><? paginate($start,$q_limit,$no_rows,$filePath,"");?></td>
		  </tr>
			<?php } else{?>
            <tr align="center" bgcolor="#EBEBEB">
              <td height="8" colspan="5"><font color="#FF0000">No Administrators Here.</font></td>
              </tr>
			<?php  }?>
            <tr>
              <td colspan="5" align="right" style="padding:10px;"><input type="button" name="New Member" value="Add Member" onClick="javascript:document.location.href='add_edit_members.php?act=new'" class="commonbut">
			  </td>
            </tr>
        </table>
		<? ?>
		</td>
      </tr>
    </table>
	<?php // }/// main if end?>
							</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top"><?php include "includes/footer.php";?></td>
                      </tr>
                      <tr>
                        <td valign="top" height="10px"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="10px"></td>
                  </tr>
                </table>
				</td>
              </tr>
            </table>
			</td>
          </tr>
        </table>
		</td>
      </tr>
      <tr>
        <td height="13px"></td>
      </tr>
    </table></td>
  </tr>
</table>
</center>
</body>
</html>
