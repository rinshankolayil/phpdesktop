<?php
include_once('config.php');
?>
<body>
  <div class="d-flex" id="wrapper">
    <?php include_once('sidebar.php'); ?>
    <div id="page-content-wrapper">
    <?php include_once('navbar.php'); ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-lg-6">
            <h1 class="mt-4">Settings</h1>
          </div>
        </div>
        <div class="row pt-4">
          <div class="col-md-1 col-sm-1 col-lg-1"></div>
          <div class="col-md-10 col-sm-10 col-lg-10">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Printing configuration
                    </button>
                  </h2>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <form id="form" method="post" action="url_router.php?class_name=SiteController&function_name=save_print_config">
                        <div class="form-group">
                          <?php 
                            $file="static/css/print.css";
                            $linecount = 0;
                            $handle = fopen($file, "r");
                            while(!feof($handle)){
                              $line = fgets($handle);
                              $linecount++;
                            }
                            $linecount = $linecount/4;

                            fclose($handle);

                            
                          ?>
                        <textarea class="form-control" rows="<?=$linecount;?>" name="print_css">
                        <?php  
                          if ($file = fopen($file, "r")) {
                            while(!feof($file)) {
                                $line = fgets($file);
                                ?>
                                <?php
                                echo ltrim($line);
                            }
                            fclose($file);
                        }
                        ?>
                        </textarea>
                      </div>
                         <div class="form-group">
                          <button type="submit" class="btn btn-warning">Save configuration</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

               <div class="card">
                <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                     Upload logo image
                    </button>
                  </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="validatedCustomFile">
                          <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                          <div class="d-n" id="name_of_file"></div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                     Set logo type
                    </button>
                  </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                      <form id="form" method="post" action="url_router.php?class_name=SiteController&function_name=logo_image_default">
                          <input type="hidden" name="logo_path" value="img_logo_default.jpg">
                          <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="0" name="logo_post" checked="checked">Set logo as default image
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="1" name="logo_post">Set logo as text
                          </label>
                        </div>
                         <br><br>
                         <div class="form-group">
                          <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>


              <div class="card">
                <div class="card-header" id="headingFour">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Print view
                    </button>
                  </h2>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                      <form id="form" method="post" action="url_router.php?class_name=TopFormDB&function_name=update_print_view">
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="0" name="print_view" checked="checked">Disable
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="1" name="print_view" checked="checked">Enable
                          </label>
                        </div>
                        <br><br>
                         <div class="form-group">
                          <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingFive">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                      Reset table index
                    </button>
                  </h2>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                      <form id="form" method="post" action="url_router.php?class_name=TopFormDB&function_name=update_table_index">
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="item_table" name="reset_table_index">Item table
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="selected" name="reset_table_index" checked="checked">Selected
                          </label>
                        </div>
                        <br>
                          <span class="r">Only developer can edit this</span><br>
                         <div class="form-group mt-2">
                          <button type="submit" class="btn btn-warning" <?=$disabled;?> >Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="headingSix">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                      Set home page
                    </button>
                  </h2>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                      <form id="form" method="post" action="url_router.php?class_name=TopFormDB&function_name=update_home_page">
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="0" name="update_home_page">Defualt
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="2" name="update_home_page">Items
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="4" name="update_home_page" checked="checked">Add new invoice
                          </label>
                        </div>
                        <div class="form-check-inline">
                          <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="3" name="update_home_page">Sales report
                          </label>
                        </div>
                        <br><br>
                         <div class="form-group">
                          <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="headingSeven">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                      Delete all
                    </button>
                  </h2>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                      <form id="form" method="post" action="url_router.php?class_name=TopFormDB&function_name=delete_all_invoice">

                        <span class="r">Only developer can change this</span>
                         <div class="form-group mt-2">
                          <button type="submit" class="btn btn-warning" <?=$disabled;?>>Delete all</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="headingeight">
                  <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">
                      Are you developer
                    </button>
                  </h2>
                </div>
                <div id="collapseeight" class="collapse" aria-labelledby="headingeight" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-7 col-md-7 col-sm-7">
                      <form id="form" method="post" action="url_router.php?class_name=TopFormDB&function_name=is_developer">
                         <div class="form-group">
                          <input type="text" name="is_developer" class="form-control" placeholder="Enter the auth key of developer" required>
                        </div>
                         <div class="form-group">
                          <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>



            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#validatedCustomFile').on('change',function(event){
      event.preventDefault()
      var file = document.getElementById("validatedCustomFile").files[0];
      $('#name_of_file').removeClass('d-n');
      $('#name_of_file').text(file.name);
      file_name = file.name
      file_name_split = file_name.split('.')
      extension = file_name_split.slice(-1)[0].toLowerCase()
      if (extension =='jpeg' || extension == 'jpg' || extension == 'png'){
        var form_data = new FormData();
        form_data.append('file',file);
        $.ajax({
          url: 'url_router.php?class_name=SiteController&function_name=upload_logo_image',
          type: 'POST',
          cache: false,
          contentType: false,
          processData: false,
          data:form_data,
          success:function(response){
            window.location.href = window.location
          }
        });
      }
      else{
        $('#name_of_file').text('File type not allowed');
      }
      console.log()
    });
    
  });
</script>


<!-- INSERT INTO hotel_info (hotel_address,hotel_phone,hote_liscence,hotel_info,mobile,hotel_name) VALUES('Near Town Bus stand, T.B Road, Palakkad','0491 - 2521450','113 12 009 000832','The Family resturant A/C','9846658608','Top Form') -->