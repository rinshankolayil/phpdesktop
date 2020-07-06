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
          <div class="mt-4 col-md-6 col-sm-6 col-lg-6"></div>
          <div class="mt-4 col-md-6 col-sm-6 col-lg-6 text-right">
            <button class="btn btn-info" id="add_new_item"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add new item</button>
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
    $('#add_new_item').click(function(event) {
      event.preventDefault();
      $.ajax({
        url: 'url_router.php?class_name=SiteController&function_name=add_new_item_html',
        type: 'POST',
        success : function(response){
          $('#modal_content').html(response);
          $('#mymodal').modal('show');
        }
      }); 
    });
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
    $.ajax({
      url: 'url_router.php?class_name=TopFormDB&function_name=select_items',
      type: 'POST',
      success : function(response){
        if(response != ''){
          $('#items_tbody').append(response);
        }
        else{
          response_null = '<tr><td colspan="5">No Items to display</td></tr>';
          $('#items_tbody').append(response_null);
        }
        $('#myTable').DataTable();
        // alert(response)
      }
    });
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
    
  });
</script>
