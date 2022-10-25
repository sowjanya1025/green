<?php 
session_start();
if(!isset($_SESSION['adminId']))
{
	header("Location:index.php");
}
require_once('database.php');
$db = new databaseconnection();

$errdata = 0;
$texterr = "";

if(isset($_POST))
{
	extract($_POST);
	if(isset($_POST['action']) && $_POST['action'] == 'aboutus' )
	{
		//echo "heree";
		//exit;
		if(empty($_POST['myeditor']))
		{
			$errdata=1;
			$texterr = "please give some information";
		}
		if($errdata == 0)
		{
			
			$descr = $_POST['myeditor']; 
			//echo $descr;
			//exit;
			//$sani = new sanitizeforminputs("$descr");
			
			//echo $sani->data;
			//var_dump($sani);
			//exit;
			//$sqlquery = "INSERT INTO `admin_aboutus`( 	aboutus_title ,`aboutus_description`) VALUES ('Aboutus', '$sani->data')";
			$sqlquery = "INSERT INTO `admin_aboutus`( 	aboutus_title ,`aboutus_description`) VALUES ('Aboutus', '$descr')";
			$resut = $db->getSqlQuery($sqlquery);
			echo "<script>alert('data inserted')</script>";
			header("Location:admin_about.php");
			exit;
		}
  }
}
$query = "select * from admin_aboutus ";
$resut = $db->getSqlQuery($query);
$adminrows = $db->getSqlNumber();
if($adminrows > 0)
{ 
  while($adminsdata = $db->getSqlFetchdata())
  {
    $aboutusdata = $adminsdata['aboutus_description'];
  }
}

if(isset($_POST))
{
  
	extract($_POST);
	if(isset($_POST['action']) && $_POST['action'] == 'edit' )
	{
		//echo "heree";
		//exit;
		if(empty($_POST['myeditor']))
		{
			$errdata=1;
			$texterr = "please give some information";
		}
		if($errdata == 0)
		{
			
			$descr = $_POST['myeditor']; 
			//echo $descr;
			//exit;
			//$sani = new sanitizeforminputs("$descr");
			
			//echo $sani->data;
			//var_dump($sani);
			//exit;
			//$sqlquery = "INSERT INTO `admin_aboutus`( 	aboutus_title ,`aboutus_description`) VALUES ('Aboutus', '$sani->data')";
			
      $sqlquery = "UPDATE admin_aboutus set `aboutus_description` = '$descr'";
			$resut = $db->getSqlQuery($sqlquery);
			header("Location:admin_about.php");
			exit;
		}
  }

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
<script type="text/javascript" src="includes/ckeditor/ckeditor.js"></script>
  <script src="https://cdn.ckeditor.com/4.17.2/standard-all/ckeditor.js"></script>

<!--<script>
        window.onload = function() {
           CKEDITOR.replace('myeditor');
        };
 </script>
--> 
 <script>
  window.onload = function() {
    CKEDITOR.replace('myeditor', {
      height: 280,
      // List of text formats available for this editor instance.
      format_tags: 'p;h1;h2;h3;h4;h5;h6;pre;address;div',
      removeButtons: 'PasteFromWord'
    })};
  </script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME?>:: Admin - About</title>
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
							
							
	<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
		  <tr>
			<td height="50" class="subheadingtwo" align="left"><div align="left">About</div></td>
		  </tr>
		  <tr>
			<td>
			<form name="adminaboutus" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
			<!-- <input type="hidden" name="action" value="aboutus" /> -->
      <input type="hidden" name="action" value="edit" />
			<table width="100%"  border="0" cellspacing="0" cellpadding="4" >
            <tr align="center">
              <td colspan="5" align="center" valign="middle">
                <span style="color:#FF0000"><?php if($texterr!='') { echo $texterr; }  ?></span></td>
            </tr>
            <tr align="center">
              <td>&nbsp;</td>
              <td align="left" >Title</td>
              <td><strong>:</strong></td>
              <td align="left">About</td>
              <td>&nbsp;</td>
            </tr>
            <tr align="center">
              <td>&nbsp;</td>
              <td align="left" valign="top">Description</td>
              <td valign="top"><strong>:</strong></td>
              <td align="left">
                <textarea name="myeditor" id="myeditor" cols="100" rows="10">
                  <?php echo $aboutusdata ?></textarea>
				</td>
              <td>&nbsp;</td>
            </tr>
            <?php /*?><tr align="center">
              <td>&nbsp;</td>
              <td align="left">Status</td>
              <td><strong>:</strong></td>
              <td align="left"><input name="news_status" type="radio" value="1" checked>
                Yes 
           <input name="news_status" type="radio"
		    value="0" <?php if( isset($news_status) && $news_status == 0 ){ echo "checked";}?>>No</td>
              <td>&nbsp;</td>
            </tr><?php */?>
            
            <tr align="center">
              <td width="5%" height="1">&nbsp;</td>
              <td width="10%" height="1" align="left">&nbsp;</td>
              <td width="5%" height="1">&nbsp;</td>
              <td width="75%" height="1">&nbsp;</td>
              <td width="5%" height="1">&nbsp;</td>
            </tr>
            <tr>
              <td height="20" colspan="4" align="right">
			  <input name="Submit" type="submit" class="commonbut" id="Submit" value="Edit" />
              <input name="Button" type="button" class="commonbut" id="Submit" value="Cancel" onClick="history.back();" />                </td>
              <td height="20" align="right">&nbsp;</td>
            </tr>
        </table>
		</form>
			</td>
		  </tr>
	</table>
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
