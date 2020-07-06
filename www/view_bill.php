<?php
include_once('config.php');
?>
<body>
  <div class="d-flex" id="wrapper">
    <?php include_once('sidebar.php'); ?>
    <div id="page-content-wrapper">
    <?php include_once('navbar.php'); 
          if(!isset($render_from)){
        ?>
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-md-9 col-sm-9 col-lg-9">
            <h1 class="h1">View bill</h1>
          </div>
        </div>
        <div class="row ">
          <div class="col-md-4 col-sm-4 col-lg-4"></div>
          <div class="col-md-4 col-sm-4 col-lg-4 mt-4 border">
            <?php if(isset($_GET['item_none'])){
              ?>
              <br>
              <div class="alert alert-warning">
                <strong>Warning!</strong> No such item.
              </div>
             <?php 
            }
            ?>
            <form id="search_bill" method="post" action="url_router.php?class_name=SiteController&function_name=select_bill_item">    
              <div class="form-group">
                <br>
                <label>Filter By</label><br>
                <div class="text-center">


                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input change_url" function_name="select_bill_item" value="invoice" name="filter_invoice" checked="checked">Invoice
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input change_url" function_name="select_invoices" value="phone" name="filter_invoice">Phone number
                    </label>
                  </div>
                  <div class="form-check-inline">
                    <label class="form-check-label">
                      <input type="radio" class="form-check-input change_url" function_name="select_invoices" value="name" name="filter_invoice">Name
                    </label>
                  </div>
                </div>
                <label for="invoice_number" class="pb-4 pt-4">Enter invoice number</label>
                <input type="text" class="form-control" id="invoice_number" placeholder="Enter invoice number or phone number" name="invoice_number">
              </div>
              <div class="pt-4 pb-4">
                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i>&nbsp&nbsp;Search</button>
              </div>
            </form>
          </div>
        </div>
      </div>
        <?php
          }
          if(isset($render_from)){
            $item_render = true;
          ?>
            <div class="container-fluid">
              <h2 class="h2 text-center pt-4">INVOICE DETAILS</h2>
              <h3 class="h3 text-center pt-4">Top Form</h3>
              <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4">
                  <table cellpadding="6">
                    <tr>
                      <td>Customer name</td>
                      <td><?=$item['customer_name'];?></td>
                    </tr>
                    <tr>
                      <td>Customer Phone</td>
                      <td><?=$item['customer_number'];?></td>
                    </tr>
                    <?php if($item['customer_location']){ ?>
                    <tr>
                      <td>Customer Location</td>
                      <td><?=$item['customer_location'];?></td>
                    </tr>
                     <?php } ?>
                  </table>
                </div>
                <div class="col-md-4 col-sm-4 col-lg-4"></div>
                <div class="col-md-4 col-sm-4 col-lg-4 float-right">
                  <table cellpadding="6">
                    <tr>
                      <td>Invoice number</td>
                      <td><?=$item['invoice_number'];?></td>
                    </tr>
                    <tr>
                      <td>Cashier name</td>
                      <td><?=$item['cashier_name'];?></td>
                    </tr>
                    <tr>
                      <td>Total</td>
                      <td><?=$item['total_price_bill'];?></td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col pt-4">
                  <table class="table">
                    <thead>
                      <th>#</th>
                      <th>Item code</th>
                      <th>Item Name</th>
                      <th>Item Quantity</th>
                      <th>Item Price</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                      <?php if($item['html'] == true){
                        echo $item['html_content'];
                      }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th colspan="2" class="text-left">
                          <input type="hidden" name="total_price_bill" id="total_price_bill_input" value="0">
                          <p><span id="total_price_bill"><?=$item['total_price_bill'];?></span>&nbsp;&nbsp;INR</p>
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6">
                  <button class="btn btn-warning" id="print_bill"><i class="fa fa-print"></i>&nbsp;&nbsp; Print</button>
                  <a href="url_router.php?class_name=SiteController&function_name=select_bill_item_edit&invoice_number=<?php echo $item['invoice_number']; ?>" class="btn btn-warning"><i class="fa fa-print"></i>&nbsp;&nbsp; Edit</a>
                </div>
              </div>
            </div>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</body>
<?php 
  if ($item['print_view'] == '0'){
    $class_print_view = 'd-n';
  }
  else{
    $class_print_view = 'd-b';
  }
if(isset($render_from)){
  $item_render = true;
?>
<div class="<?=$class_print_view;?>" id="scroll_div">
  <page size="A4">
    <div id="print_div">
      <link rel="stylesheet" type="text/css" href="static/css/print.css">
      <div class="center_content">
        <?php if($item['hotel_logo_type'] == 2){
          echo $item['hotel_name'];
        }
        else if($item['hotel_logo_type'] == 1){
          echo '<img src="static/logos/img_logo_default.jpg" class="logo_image">';
        }
        else if($item['hotel_logo_type'] == 0){
          echo '<img src="static/logos/img_logo.jpg" class="logo_image">';
        }
        ?>
        <?=$item['hotel_details'];?>
        <hr style="border: 1px dashed black;">
        <p>CASH BILL</p>
      </div>
      
      <div class="bill_info">
        <table cellpadding="2" id="bill_info_table">
          <tr>
            <?php
            date_default_timezone_set('Asia/Kolkata');
            $time = date('h:i:s a', time());
            $date_ony = date('Y-m-d', time());
            ?>
              <td class="left">SL. No.: <span style="margin-left: 15px;"><?=$item['invoice_number'];?></span></td>
              <td class="right">Date: <span style="margin-left: 15px;"><?=$item['bill_date'];?></span></td>

          </tr>
          <tr>
              <td class="left">Cashier name:<span style="margin-left: 15px;"><?=$item['cashier_name'];?></span></td>
              <td class="right">Time: <span style="margin-left: 15px;"><?=$item['bill_time'];?></span></td>
          </tr>
          <tr>
              <td class="left">To:<span style="margin-left: 15px;"><?=$item['customer_name'];?></span></td>
          </tr>
        </table>
      </div>
      <hr style="border: 1px dashed black;">
      <div class="item_details">
        <table id="table_item_details">
          <thead>
              <th>Item Name</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Total</th>
            </thead>
            <tbody>
              <?=$item['print_html'];?>
            </tbody>
            <tfoot>
              <?=$item['print_foot'];?>
            </tfoot>

        </table>
      </div>
      <br>
      <div class="center_content">
       <table id="total_table">
         <tr>
           <th>Total : </th>
           <th><?=$item['total_price_bill'];?></th>
         </tr>
       </table>
         
         
      </div>
      <hr style="border: 1px dashed black;">
      <div class="center_content">
        <p>THANK YOU VISIT AGAIN</p>
      </div>
    </div>
  </page>
</div>
<?php
}
?>
<script type="text/javascript">
  var scroll_to = '<?php echo $item['print_view'];?>';
  if (scroll_to==1){
    $('html,body').animate({scrollTop: $("#scroll_div").offset().top},'slow');
  }
  $(document).ready(function() {
    $('.change_url').change(function(event) {
      event.preventDefault();
      var function_name = $(this).attr('function_name');
      var url = "url_router.php?class_name=SiteController&function_name="+function_name;
      
      $('#search_bill').attr('action', url);

    });
    $('#print_bill').click(function(event) {
      event.preventDefault();
      print_div = $('#print_div').html();
      var popupWin = window.open('', '_blank');
      popupWin.document.open();
      popupWin.document.write('<html><body onload="window.print()">'+print_div+'</html>');
      popupWin.document.close();
    });

    $('#invoice_number').keypress(function(event) {
      if(event.which == 13){
        $('#search_bill').submit()
      }
    });
  }); 
  

</script>