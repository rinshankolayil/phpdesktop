<?php
include_once('config.php');
?>

</style>

<body>
  <div class="d-flex" id="wrapper">
    <?php include_once('sidebar.php'); ?>
    <div id="page-content-wrapper">
    <?php include_once('navbar.php'); ?>
      <form method="POST" action="url_router.php?class_name=SiteController&function_name=view_and_save_bill">
        <div class="container-fluid">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-8 col-sm-6">
                <h1 class="mt-4">Add new bill</h1><br>
              </div>
              <div class="col-md-4 col-sm-4 mt-4 text-right form-group">
                <input type="text" name="cashier_name" class="form-control" value="<?=$item[0]['cashier_name'];?>" placeholder="Enter cash holder name" required>
              </div>
            </div>
          </div>
          <table class="table" id="bill_table">
            <thead>
              <th>#</th>
              <th>Item code</th>
              <th>Item Name</th>
              <th>Item Quantity</th>
              <th>Item Price</th>
              <th>Total</th>
              <th></th>
            </thead>
            <!-- hidden variables not posting -->
            <input type="hidden" id="available_sources" value="0">
            <input type="hidden" id="price_list" value="0">
            <?php
              $total_price = $item[0]['total_price_bill'];
            ?>
            <input type="hidden" id="total_rows" name="total_rows" value="<?=$item[0]['items_total'];?>" price="<?=$item[0]['price_str'];?>" added="1">
            <input type="hidden" id="customer_modal" value="0">
            <!-- hidden variables not posting -->

            <!-- hidden variables posting -->
            <input type="hidden" id="customer_name" name="customer_name" value="<?=$item[0]['customer_name'];?>">
            <input type="hidden" id="customer_number" name="customer_number" value="<?=$item[0]['customer_number'];?>">
            <input type="hidden" name="invoice_number" value="<?=$item[0]['invoice_number'];?>">
            <input type="hidden" id="customer_location" name="customer_location" value="<?=$item[0]['customer_location'];?>">
            
            <!-- hidden variables posting -->
            <tbody id="bill_body">
              <?php include_once('bill_edit_tbody.php');?>
            </tbody>
            <tfoot>
            <tr>
              <th colspan="5" class="text-right">Total</th>
              <th colspan="2" class="text-left">
                <input type="hidden" name="total_price_bill" id="total_price_bill_input" value="<?=$total_price;?>">
                <p><span id="total_price_bill"><?=$total_price;?></span>&nbsp;&nbsp;INR</p>
              </th>
            </tr>
          </tfoot>
          </table>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <button class="btn btn-info" id="btn_add_row_bill"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add row</button>
                <button class="btn btn-warning" id="btn_add_customer_details"><i class="fa fa-user"></i>&nbsp;&nbsp;Customer info</button>
              </div>
              <div class="col-md-6 col-sm-6 col-lg-6 text-right">
                <button type="submit" class="btn btn-danger" id="save_bill"><i class="fa fa-eye"></i>&nbsp;&nbsp;Save and View</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
<script type="text/javascript">
  $(document).ready(function() {

    $('#btn_add_row_bill').click(function(event) {
      event.preventDefault();
      var current_row_num = $('#total_rows').val()
      new_row_num = Number(current_row_num) + 1
      $('#total_rows').val(new_row_num)
      $.ajax({
      url: 'new_row.php',
      type: 'POST',
      data:{row_num:new_row_num},
      success : function(response){
        $('#bill_body').append(response)
      }
    });
  });
    $.ajax({
      url: 'url_router.php?class_name=TopFormDB&function_name=select_items_code',
      type: 'POST',
      success : function(response){
        var array = JSON.parse(response);
        $('#available_sources').val(array[0]);
        $('#price_list').val(JSON.stringify(array[1]))
        document_ready()
      }
    });
    $('#btn_add_customer_details').click(function(event) {
      event.preventDefault();
      $.ajax({
      url: 'url_router.php?class_name=SiteController&function_name=modal_customer_details',
      type: 'POST',
      success : function(response){
        modal_shown = $('#customer_modal').val()
        if(modal_shown == 0 || modal_shown =='0'){
          $('#modal_content').html(response);
          cname = $('#customer_name').val();
          cnumber = $('#customer_number').val();
          clocation = $('#customer_location').val();
          $('#customer_name_form').val(cname);
          $('#customer_number_form').val(cnumber);
          $('#customer_location_form').val(clocation);
          $('#customer_modal').val(1)
        }
        $('#mymodal').modal('show')

      }
    });
    });

    $('#bill_table').on('click','.edit_row_bill',function(event) {
      event.preventDefault();
      var confirm = window.confirm("Are you sure want to edit?");
      if (confirm){
        var row_num = $(this).attr('row_num')
        var p = '#item_code_row_' + row_num;
        var input = '#item_code_row_input_' + row_num;
        
        $(p).hide();
        $(input).show()
        update_price(0,row_num,'edit','+')
        return false;
      }
      else{
        return false;
      }
    });
    $('#bill_table').on('click','.delete_row_bill',function(event) {
      event.preventDefault();
      var confirm = window.confirm("Are you sure want to delete?");
      if (confirm){
        var row_num = $(this).attr('row_num');
        var delete_row = '#delete_row_'+row_num;
        $(delete_row).val(1)
        
        var current_row_num = $('#total_rows').val()
        new_row_num = Number(current_row_num) - 1
        $('#total_rows').val(new_row_num)

        var row = '#row_' + row_num;
        $(row).hide();
        update_price(0,row_num,'delete','+')
        return false;
      }
      else{
        return false;
      }
    });
    $('#bill_table').on('click','.qty_plus',function(event) {
      event.preventDefault()
      var row_num = $(this).attr('row_num');
      var item_qty = '#item_qty_' + row_num;
      var item_qty_input = '#item_qty_input_' + row_num
      qty = Number($(item_qty_input).val())
      new_qty = Number(qty + 1)
      $(item_qty_input).val(new_qty)
      $(item_qty).html(new_qty)
      update_price(0,row_num,'qty','+')
    });
    $('#bill_table').on('click','.qty_minus',function(event) {
      event.preventDefault()
      var row_num = $(this).attr('row_num');
      var item_qty = '#item_qty_' + row_num;
      var item_qty_input = '#item_qty_input_' + row_num
      qty = Number($(item_qty_input).val())
      new_qty = Number(qty - 1)
      if (new_qty < 1 ) new_qty = 1 
      $(item_qty_input).val(new_qty)
      $(item_qty).html(new_qty)
      update_price(0,row_num,'qty','-')
    });
    $('#bill_table').on('dblclick','.qty_class',function(event) {
      event.preventDefault();
      $(this).hide()
      var row_num = $(this).attr('row_num')
      var id = $('#item_qty_input_' + row_num)
      id.attr('type', 'text');
      var strLength = id.val().length * 2;
      id.focus()
      id[0].setSelectionRange(strLength, strLength);
    });
    $('#bill_table').on('keypress','.qty_input',function(event) {
      if(event.which == 13){
        event.preventDefault();
        var row_num = $(this).attr('row_num')
        var id = '#item_qty_input_' + row_num
        
        $(id).attr('type', 'hidden');
        var p_id = '#item_qty_' + row_num
        $(p_id).html($(this).val())
        $(p_id).show()
        update_price(0,row_num,'qty','+')
      }
    });
    $('#bill_table').on('focusout','.qty_input',function(event) {
        event.preventDefault();
        var row_num = $(this).attr('row_num')
        var id = '#item_qty_input_' + row_num
        
        $(id).attr('type', 'hidden');
        var p_id = '#item_qty_' + row_num
        $(p_id).html($(this).val())
        $(p_id).show()
        update_price(0,row_num,'qty','+')
    });
  });
  function document_ready(){
    tags = $('#available_sources').attr('value');
    availableTags = tags.split(",");
    $("#bill_table").on("click", '.autocomplte_tags',function (event) {
      $(this).autocomplete({
        source: availableTags,
        select : function(event,ui){
          var val = ui.item.value
          val_split = val.split("-")
          item_code = val_split[1]
          item_name = val_split[0]
          var row_num = $(this).attr('row_num');
          var name_append = '#item_name_row_' + row_num;
          var name_input_append = '#item_name_row_input_' + row_num
          var code_append = '#item_code_row_' + row_num;

          $(name_input_append).val(item_name)
          $(name_append).html(item_name)
          $(code_append).html(item_code)
          $(code_append).show()
          $(this).hide();
          price = display_price(item_code,row_num,'input')
        }
      });
  });
  }
 function display_price(code,row_num,type){
  if(type=='input'){
    var price_str = $('#price_list').val()
    var price_obj = JSON.parse(price_str)
    price = parseFloat(price_obj[Number(code)])
  }
  update_price(price,row_num,'display','+')
 }

 function update_price(price,row_num,type,operator){
  var price_item = '#item_price_row_' + row_num
  var price_total_row = '#item_total_row_'+ row_num
  var qty = '#item_qty_input_' + row_num

  var inp_price_item = '#item_price_row_input_' + row_num
  var inp_price_total_row = '#item_total_row_input_'+ row_num

  var val_qty = parseFloat($(qty).val())

  var new_val_price_item = 0
  var new_val_price_total_row = 0

  var val_price_item = parseFloat($(inp_price_item).val())


  if (type == 'display'){
    price_defaut = price
    price = val_qty * price
    new_val_price_item = price_defaut
    new_val_price_total_row = price
  }
  else if (type == 'edit'){
    new_val_price_item = "0.00"
    new_val_price_total_row = "0.00"
  }

  else if (type == 'qty'){
    new_val_price_total_row = 0
    price_defaut = val_price_item
    price = val_qty * price_defaut
    new_val_price_item = price_defaut
    new_val_price_total_row = price
  }

  if(new_val_price_total_row <=0) new_val_price_total_row = 0
  // update price
  $(inp_price_item).val(new_val_price_item)
  $(inp_price_total_row).val(new_val_price_total_row)
  $(price_item).text(new_val_price_item)
  $(price_total_row).text(new_val_price_total_row)

  update_total_price(new_val_price_total_row,row_num)
 }

 function update_total_price(total,row_num){
  index = Number(row_num - 1)
  var price_t = '#total_price_bill'
  var inp_price_t = '#total_price_bill_input'
  total_price = $('#total_rows').attr('price')
  $('#total_rows').attr('added', '1');
  if($('#customer_modal').val() == 1){
    $('#save_bill').prop('disabled',false)
  }
  new_array = total_price.split(",")
  new_array[index] = total
  
  for(var i in new_array){
    new_array[i] = Number(new_array[i])
  }
  const sum = new_array.reduce((partial_sum, a) => partial_sum + a,0);
  var string = new_array.toString();
  $('#total_rows').attr('price',new_array)
  $(inp_price_t).val(sum)
  $(price_t).text(sum)
 }
</script>
