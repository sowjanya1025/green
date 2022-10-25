<?php
require_once('admin/database.php');
$db = new databaseconnection();

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
?>
<section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>About Us</h2>
          
        </div>

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            
            <p><?php echo $aboutusdata;  ?></p>
          </div>
        </div>

      </div>
    </section>