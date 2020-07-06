<?php
include_once('config.php');
if(!isset($_GET['redirect'])){
  if($redirect_value == 1 || $redirect_value == 4){
    echo '<script> location.replace("bill.php")</script>';
  }
  else if($redirect_value == 2){
    echo '<script> location.replace("items.php")</script>';
  }
  else if($redirect_value == 3)
  {
    echo '<script> location.replace("url_router.php?class_name=SiteController&function_name=sales_report_submit&today=today")</script>';
  }
}
?>
<body>
  <div class="d-flex" id="wrapper">
    <?php include_once('sidebar.php'); ?>
    <div id="page-content-wrapper">
    <?php include_once('navbar.php'); ?>
      <div class="container-fluid">
        <h1 class="mt-4">Tutorial</h1>
        <div class="row">
          <div class="col-md-1 col-sm-1 col-lg-1 mt-4"></div>
          <div class="col-md-8 col-sm-8 col-lg-8 mt-4">
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn_scroll" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="btn_scroll">
                      Add an item
                    </button>
                  </h2>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <ul>
                        <li>Click on <b>Items</b> tab </li>
                        <li>Click on <b>Add new item</b> button</li>
                        <li>Fill the form with <b>Item price, item code, item name</b> and click on <b>Add new item button</b></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn_scroll" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                      Edit or Delete item
                    </button>
                  </h2>
                </div>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <ul>
                        <li>Click on <b>Items</b> tab </li>
                        <li>Click on this icon <b><i class="fa fa-edit y-code"></i></b> to edit item and fill the form and click on <b>Update</b> button</li>
                        <li>Click on this icon <b><i class="fa fa-trash bro-code"></i></b> to delete item to press <b>OK</b> to confirm or <b>Cancel</b> to discard</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card">
                <div class="card-header" id="headingThree">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn_scroll" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                      Add new invoice or bill
                    </button>
                  </h2>
                </div>

                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <ul>
                        <li>Click on <b>New invoice tab</b> tab </li>
                        <li>Type the spellings of item name or type the item code in text box
                          <br>Example : - For item tea type <b>"tea"</b> in the text box type item code of tea
                        </li>
                        <li>You can press icons such as <i class="fa fa-plus"></i> to increase number of items or <i class="fa fa-minus"></i>  to decrease number of items</li>
                        <li>You can <b>double click</b> on the number of item quantity<b> (by default "1" is shown)</b> to manualyy add the number quantity</li>
                        <li>Click on <b>Customer info</b> button to add customer details</li>
                        <li>Click on <b>Add row</b> button to add new item to bill</li>
                        <li>Add cashier name, once everything completed <b><i class="fa fa-eye"></i>&nbsp;Save and View</b> will be enabled<br>(<span class="r">Initially you can't create new invoice without above steps</span>)</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="headingFour">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn_scroll" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                      Search and view invoice
                    </button>
                  </h2>
                </div>

                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <p>Search invoice</p>
                      <ul>
                        <li>Click on <b>Search invoice</b> tab </li>
                        <li>Type the <b>invoice number of bill, name or phone number of customer</b> in the text box and click on appopreate radio buttons such as <b>Invoice, Phone number or Name</b></li>
                        <li>Click on <b>search</b> button</li>
                      </ul>
                      <p>View invoice</p>
                      <ul>
                        <li>If you choose <b>name or phone number of customer</b> in search critria it will redirect to <b>View all invoices</b> tab which will list of invoices related to the name or phone number of customer</li>
                        <li>Click on this icon <b><i class="fa fa-eye o"></i></b> on right side to view bill</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="headingSix">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn_scroll" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                      View sales report
                    </button>
                  </h2>
                </div>

                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <ul>
                        <li>Click on <b>Sales report</b> tab </li>
                        <li>By defualt it will show sales report of current date</li>
                        <li>Click on this icon <b><i class="fa fa-filter"></i></b> to filter your results and select <b>from and to date</b> and options such as <b>Day, year month</b></li>
                        <li>It will discard the day you choose, only year and month will be applicable when you choose <b>Year and month</b> options</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card">
                <div class="card-header" id="headingSeven">
                  <h2 class="mb-0">
                    <button class="btn btn-link btn_scroll" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                      Edit settings
                    </button>
                  </h2>
                </div>

                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <ul>
                        <li>Click on <b>Settings</b> tab </li>
                        <li>You can view print preview by <b>Enable</b> in print preview section and will visible when you create new invoice or search existing invoice</li>
                        <li>You can set home page in <b>Set home page</b> section, which will automatically redirect home page on startup of application</li>
                        <li>You can set new image as hotel logo which bill be visible in invoices</li>
                        <li>Please don't reset <b>table index</b>, only for developer</li>

                      </ul>
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
    $('#accordionExample').on('shown.bs.collapse', function (e) {
        var top = $(document).height();
        var head_height = $('.card-header').height()
        scroll_to = top - head_height
        $("html, body").animate({ scrollTop: scroll_to}, "slow");
    });
  });

</script>