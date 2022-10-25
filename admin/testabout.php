<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
    <script type="text/javascript" src="includes/ckeditor/ckeditor.js"></script>
	    <script>
        window.onload = function() {
           CKEDITOR.replace('myeditor');
        };
    </script>
</head>
    <textarea name="myeditor" id="myeditor">Welcome to the Mitrajit's Tech Blog</textarea>
<body>
    <?php
    $hashedPassword =  password_hash("admin", PASSWORD_DEFAULT);
    echo $hashedPassword ;
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
     ?>
</body>
</html>
