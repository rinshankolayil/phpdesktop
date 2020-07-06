<?php
include_once('config.php');
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d H:i:s', time());
$date_ony = date('Y-m-d', time());
if(isset($item['date'])){
  $date_ony = $item['date'];
}
?>
<body>
  <div class="d-flex" id="wrapper">
    <?php include_once('sidebar.php'); ?>
    <div id="page-content-wrapper">
    <?php include_once('navbar.php'); ?>
      <div class="container-fluid">
        <div class="row">
          <div class="mt-4 col-md-3 col-sm-3 col-lg-3">
            <form method="POST" action="url_router.php?class_name=SiteController&function_name=select_invoices">
              <div class="form-group">
                <label for="from_date">Date</label>
                <input type="text" class="form-control datepicker" id="from_date" name="date" aria-describedby="nameHelp" placeholder="Enter from date" value="<?=$date_ony;?>">
              </div>
              <button class="btn btn-info" id="add_new_item"><i class="fa fa-search"></i>&nbsp;&nbsp;&nbsp;Search</button>
            </form>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12">
            <table class="table" id="myTable">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Item name</th>
                  <th scope="col">Item code</th>
                  <th scope="col">Price</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody id="items_tbody">
                <?php if(isset($item['result_html'])){
                  echo $item['result_html'];
                } 
                ?>   
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>



<!--  -->
<script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').on('click','.delete_item',function(event) {
      event.preventDefault();
      var item_code = $(this).attr('item_code');
      var confirm = window.confirm("Are you sure want to delete item?")
      if(confirm){
        $.ajax({
          url: 'url_router.php?class_name=TopFormDB&function_name=delete_item',
          type: 'POST',
          data:{item_code:item_code},
          success : function(response){
            window.location.href = window.location;
          }
        }); 
      }
      return false;

    });
    
    var item = '<?php if(isset($item)) { echo 'not null';} else{echo 'null'; }?>';
    if(item == 'null'){
      $.ajax({
        url: 'url_router.php?class_name=TopFormDB&function_name=select_invoices',
        type: 'POST',
        data:{'ajax':'true'},
        success : function(response){
          $('#items_tbody').append(response);
          $('#myTable').DataTable();
        }
      });
    }
    else{
      $('#myTable').DataTable();
    }

    $("#myTable").on("click", ".edit_item_details", function(){
      id = $(this).attr('edit_id');
      item_name = $(this).attr('item_name')
      item_code = $(this).attr('item_code')
      item_price = $(this).attr('item_price')
      $.ajax({
        url: 'url_router.php?class_name=SiteController&function_name=edit_item_html',
        type: 'POST',
        data:{item_name:item_name,item_code:item_code,item_price:item_price},
        success : function(response){
          $('#modal_content').html(response);
          $('#id_').val(id);
          $('#item_name').val(item_name);
          $('#item_code').val(item_code)
          $('#item_price').val(item_price)
          $('#mymodal').modal('show');
           // alert(response)
        }
      }); 
    
    });
    $(".datepicker").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true,
    });
  });
</script>
