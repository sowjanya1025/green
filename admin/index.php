<?php
require_once('database.php');
$msgerr = "";
///echo var_dump($msgerr);
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
	//echo $_POST['username'];
	//echo $_POST['pword'];
	//$user = trim($_POST['username']);
	//$pwd =  trim($_POST['pword']);
    $user = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $pwd = filter_var($_POST["pword"], FILTER_SANITIZE_STRING);	
/*	$stmt = $mysqli->prepare("SELECT id, name, age FROM myTable WHERE name = ?");
$stmt->bind_param("s", $_POST['name']);
$stmt->execute();
$arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
if(!$arr) exit('No rows');
var_export($arr);
$stmt->close();
*/	
	$db = new databaseconnection();
	$query = "select id,name,password from admin_users where name = '$user' ";
	$result = $db->getSqlQuery($query);
	$rows = $db->getSqlNumber();
	//echo $rows;
	if($rows > 0)
	{
		$userdata =  $db->getSqlFetchdata();
		$userpswd = $userdata['password'];
		if(password_verify($pwd,$userpswd))
		{	
			session_start();
			$_SESSION['adminId']= $userdata['id'];	
			header('Location:dashboard.php');
		}
		else
		{
			//echo "Invallid password";
			$msgerr = "Invalid password";
		}
		
		
	}else
	{
		$msgerr = "Invalid user";
	}
}
?>
<script type="text/javascript">
function checksubmit()
{
	uname = document.getElementById('username').value;
	upswd = document.getElementById('pword').value;
	if(uname == '')
	{
		//alert('username required');
		document.getElementById("utexthint").innerHTML = "Username required";
		return false;
	}
}
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME ?> :: Admin</title>
<link href="includes/styles.css" rel="stylesheet" type="text/css" />
</head>
<link href="includes/style.css" rel="stylesheet" />
<body>
<table align="center" width="735" height="355px" border="0" cellspacing="0" cellpadding="0" style="padding-top:100px;">
  <tr>
    <td>
	<table width="735" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="253px" style="background:url(images/login-left.gif); width:253px; height:355px; background-repeat:no-repeat;"></td>
        <td style="background:url(images/bg-login.gif); background-repeat:repeat-x;" width="458px" valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="58px" colspan="3"></td>
            </tr>
          <tr>
            <td>&nbsp;</td>
            <td align="right" style="background:url(images/bg-loginmain.gif); width:243px; height:230px; background-repeat:no-repeat;" valign="top">
			<table width="243" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="90px">&nbsp;</td>
              </tr>
              <tr>
                <td>
				<form  name="loginform" method="post"
				 action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" onSubmit="return checksubmit(this)" > 
				<table align="center" width="205" border="0" cellspacing="0" cellpadding="0">
				<?php if($msgerr !=''){ ?>
                  <tr>
                    <td height="30px" colspan="3" align="center">
					<font color="red" face="Verdana" size="2"><?=$msgerr?></font></td>
                    </tr>
					<?php } ?>
                  <tr>
                    <td width="70" height="30px" align="left" class="subtext1">User Name</td>
                    <td align="center" width="20">:</td>
                    <td align="left"><INPUT id="username" size="20" name="username" maxlength="30" class="inputone">
					</td>
                  </tr>
                  <tr>
                    <td align="left" height="30px" class="subtext1">Password</td>
                    <td align="center">:</td>
                    <td align="left"><INPUT id="pword" type="password" size="20" name="pword" class="inputone"></td>
                  </tr>
                  <tr>
                    <td height="20px" colspan="3" align="left">&nbsp;</td>
                    </tr>
                  <tr>
                    <td align="left" height="25px">&nbsp;</td>
                    <td align="center">&nbsp;</td>
                    <td align="left" height="30px"><INPUT name="adminloginok" 
            type="image" id="adminloginok" value="Login" src="images/login.gif" width="79" height="19" ></td>
                  </tr>
                </table>
				</form>
				</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
            <td width="30px"></td>
          </tr>
        </table></td>
        <td width="24px" bgcolor="#ffffff"></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>
