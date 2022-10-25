<?php
session_start();
if(!isset($_SESSION['adminId']))
{
	header("Location:index.php");
}
//echo $_SESSION['adminId'];
//exit;
require_once('database.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME ?> :: Admin</title>
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
                        <td><?php include 'includes/header.php'?></td>
                      </tr>
                      <tr>
                        <td height="10px"></td>
                      </tr>
                      <tr>
                        <td valign="top">
						<table width="956" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="200" height="400px" valign="top">
							<?php include 'includes/leftpanel.php'?>
							</td>
                            <td width="10" bgcolor="#ffffff">&nbsp;</td>

                            <td width="746px" align="center" class="welcometextone">Welcome to<br /> 
                              <font class="welcometexttwo"><?php echo WEBSITE_NAME ?></font> Admin Panel</td>
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
