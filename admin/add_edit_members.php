<?php 
session_start();
if(!isset($_SESSION['adminId']))
{
	header("Location:index.php");
}
require_once('database.php');
$db = new databaseconnection();

	$nameErr = $pswderr=  $emailErr = "";
	$name = $password =  $email = $status = "";
	$dataerror = 0;
	//	echo $name;
	//	print_r($_SESSION);
		
	//exit;
	if(isset($_GET['aid'])){
	$aid = $_GET['aid'];
}
///code for php validations
if((isset($_POST)))
{
	extract($_POST);
	if(isset($action)=='new' || isset($action)=='edit')
	{
	$name = $_POST['admin_username'];
	
	//exit;
	$email = $_POST['admin_email'];
	$status = $_POST['admin_status'];
	//// check if name only contains numbersletters and whitespace
	if (!preg_match("/^[a-zA-Z-0-9' ]*$/",$name)){
 	 $nameErr = "Only nummbers & letters allowed";
	 $dataerror = 1;
	}else{
		$name = sanitizeformdata($name);
	} 
	$password = $_POST['admin_password'];
	if(!empty($password))
	{
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
	   $emailErr = "Invalid email format";	
	  $dataerror = 1;
	 }else 
	 {
	 	$email = sanitizeformdata($email);
	 }
	 if((isset($action) && $action =='new')  && ($dataerror != 1))
	 {
	$sqlquery = "INSERT INTO `admin_users`
				(`name`, `email`, `password`,`status`) VALUES ('$name','$email','$hashedPassword','$status') ";
				
	$resut = $db->getSqlQuery($sqlquery);
	echo "<script>alert('data inserted')</script>";
	header("Location:admin_members.php");
	exit;
	}
	  if((isset($action) && $action =='edit')  && ($dataerror != 1))
	 {
	$sqlquery =	   "UPDATE `admin_users` SET
					`name`='$name', `email`='$email', `status`='$status', `updated_date`=now()
					 WHERE id = '$aid' ";
	$resut = $db->getSqlQuery($sqlquery);
	echo "<script>alert('data inserted')</script>";
	header("Location:admin_members.php");
	exit;
	}
} }
///end code for post

/// For pagination
$q_limit = 10;
$errMsg = 0;
if( isset($_GET['start']) ){
	$start = $_GET['start'];
}else{
	$start = 0;
}
$filePath = "admin_members.php";

function sanitizeformdata($data)
{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME?> :: Admin - Members</title>
<link href="includes/styles.css" rel="stylesheet" type="text/css" />
<script>
</script>
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
                        <td><?php include "includes/header.php";?></td>
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
							
	<?php if(isset($_GET['act']) && ($_GET['act']) =='new') {
	 ?>						
	<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td class="subheadingtwo">Add Admin Member</td>
		  </tr>
		  <tr>
			<td>
			<form name="admindetails"  action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" autocomplete="off"  >
			<input type="hidden" name="action" value="new" />
			<table align="center" width="70%"  border="0" cellspacing="0" cellpadding="4" class="subtext2">
			<tr align="center" bordercolor="#FF0000">
              <td colspan="4" align="center"><span style="color:#FF0000">All (*)marked fields are mandatory</span></td>
            </tr>
            <tr align="center">
              <td>&nbsp;</td>
              <td align="left">Name <span style="color:#FF0000">*</span></td>
              <td>:</td>
              <td align="left">
			  <input name="admin_username"  required type="text" id="admin_username" value="<?php echo $name;  ?>" class="inputtwo">
			  <?php echo $nameErr;?></td>
              <td>&nbsp;</td>
            </tr>
            <tr align="center">
              <td>&nbsp;</td>
              <td align="left">Password<span style="color:#FF0000">*</span></td>
              <td>:</td>
              <td align="left"><input autocomplete="new-password" required name="admin_password" type="password" id="admin_password" value=""
			  class="inputtwo"><?php echo $pswderr;?></td>
              <td>&nbsp;</td>
            </tr>
			  <tr align="center">
              <td>&nbsp;</td>
              <td align="left">Email<span style="color:#FF0000">*</span></td>
              <td>:</td>
              <td align="left"><input required  name="admin_email" type="text" id="admin_email" value="<?php echo $email  ?>" class="inputtwo"><?php echo $emailErr;?></td>
              <td>&nbsp;</td>
            </tr>
            <tr align="center">
              <td>&nbsp;</td>
              <td align="left">Status</td>
              <td>:</td>
              <td align="left"><input name="admin_status" type="radio" value="1" checked>
                Active 
                  <input name="admin_status" type="radio" value="0" >
                  Inactive</td>
              <td>&nbsp;</td>
            </tr>
            <tr align="center">
              <td width="5%" height="1">&nbsp;</td>
              <td width="29%" height="1" align="left">&nbsp;</td>
              <td width="3%" height="1">&nbsp;</td>
              <td width="58%" height="1">&nbsp;</td>
              <td width="5%" height="1">&nbsp;</td>
            </tr>
            <tr>
              <td height="20" colspan="4" align="right">
			  <input name="Submit" type="submit" id="Submit" value="Add" class="commonbut">
              <input name="Button" type="button" id="Submit" value="Cancel" onClick="history.back();" 
			  class="commonbut">                </td>
              <td height="20" align="right">&nbsp;</td>
            </tr>
        </table>
		</form>
			</td>
		  </tr>
	</table><?php } ?>
	<?php if(isset($_GET['act']) && ($_GET['act']) =='edit') { 
				$query = "select * from admin_users where id = $aid ";
				$resut = $db->getSqlQuery($query);
				$adminrows = $db->getSqlNumber();
				if($adminrows > 0)
				{
					$admindata = $db->getSqlFetchdata();
	?>						
	<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td class="subheadingtwo">Edit Admin Member</td>
		  </tr>
		  <tr>
			<td>
			<form name="admindetails" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post"  >
			<input type="hidden" name="action" value="edit" />
			<table align="center" width="70%"  border="0" cellspacing="0" cellpadding="4" class="subtext2">
            <tr align="center">
              <td>&nbsp;</td>
              <td align="left">Name <span style="color:#FF0000">*</span></td>
              <td>:</td>
              <td align="left">
			  <input name="admin_username" required type="text" id="admin_username" value="<?php echo $admindata['name']; ?>" class="inputtwo">
			  <?php echo $nameErr;?></td>
              <td>&nbsp;</td>
            </tr>
          <?php /*?>  <tr align="center">
              <td>&nbsp;</td>
              <td align="left">Password<span style="color:#FF0000">*</span></td>
              <td>:</td>
              <td align="left"><input required name="admin_password" type="password" id="admin_password" value=""
			  class="inputtwo"><?php echo $pswderr;?></td>
              <td>&nbsp;</td>
            </tr><?php */?>
			  <tr align="center">
              <td>&nbsp;</td>
              <td align="left">Email<span style="color:#FF0000">*</span></td>
              <td>:</td>
              <td align="left"><input required  name="admin_email" type="text" id="admin_email" value="<?php echo $admindata['email']; ?>" class="inputtwo"><?php echo $emailErr;?></td>
              <td>&nbsp;</td>
            </tr>
            <tr align="center">
              <td>&nbsp;</td>
              <td align="left">Status</td>
              <td>:</td>
              <td align="left"><input name="admin_status" type="radio" value="1" checked>
                Active 
                  <input name="admin_status" type="radio" value="0" >
                  Inactive</td>
              <td>&nbsp;</td>
            </tr>
            <tr align="center">
              <td width="5%" height="1">&nbsp;</td>
              <td width="29%" height="1" align="left">&nbsp;</td>
              <td width="3%" height="1">&nbsp;</td>
              <td width="58%" height="1">&nbsp;</td>
              <td width="5%" height="1">&nbsp;</td>
            </tr>
            <tr>
              <td height="20" colspan="4" align="right">
			  <input name="Submit" type="submit" id="Submit" value="Add" class="commonbut">
              <input name="Button" type="button" id="Submit" value="Cancel" onClick="history.back();" 
			  class="commonbut">                </td>
              <td height="20" align="right">&nbsp;</td>
            </tr>
        </table>
		</form>
			</td>
		  </tr>
	</table><?php } } ?>
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
