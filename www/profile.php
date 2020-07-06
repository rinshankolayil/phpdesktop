<?php
include_once('config.php');
?>
<style type="text/css">
  .input_number::-webkit-inner-spin-button, 
  .input_number::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
<body>
  <div class="d-flex" id="wrapper">
    <?php include_once('sidebar.php'); ?>
    <div id="page-content-wrapper">
    <?php include_once('navbar.php'); ?>
      <div class="container-fluid">
        <div id="contact_details">
          <div class="row">
            <div class="col-md-1 col-sm-1 col-lg-1"></div>
            <div class="col-md-10 col-sm-10 col-lg-10 border">
              <h1 class="mt-5">Profile Details</h1>
              <form id="form" method="post" action="url_router.php?class_name=TopFormDB&function_name=update_hotel_info">
              </form>
            </div>
          </div>
        </div>
        <br>
        <div id="technical_support">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-lg-3"></div>
            <div class="col-md-6 col-sm-6 col-lg-6 border text-center pt-4 pb-4">
              <h1 class="mt-4">Technical Support</h1>
              <table cellpadding="10">
                <tr>
                  <td>Name</td>
                  <td>Rinshan</td>
                </tr>
                <tr>
                  <td>Phone number</td>
                  <td>+91 9567949526</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>rinshank@gmail.com</td>
                </tr>
                <tr>
                  <td>Comapany name</td>
                  <td>Omega travels (Outomatiese)</td>
                </tr>
                <tr>
                  <td>Website</td>
                  <td><a href="https://www.outomatiese.in/" target="_blank">www.outomatiese.in</a></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <br>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
  var scroll_to ='<?php if(isset($_GET['scroll_to'])) { echo $_GET["scroll_to"];} else{echo 'null';}?>';
  if(scroll_to =='technical_support') {
    $('#contact_details').hide();
  }
  $(document).ready(function() {
      $.ajax({
          url: 'url_router.php?class_name=SiteController&function_name=load_profile_details',
          type: 'POST',
          success : function(response){
            $('#form').html(response);
          }
        }); 
  });
</script>
