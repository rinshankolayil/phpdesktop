<tr id="row_<?php echo $_POST['row_num'];?>">
  <input type="hidden" name="delete_row_<?php echo $_POST['row_num'];?>" id="delete_row_<?php echo $_POST['row_num'];?>" value="0">
  <td class="sl_no"><?php echo $_POST['row_num'];?></td>

  <td class="item_code_bill">
    <div class="ui-widget">
      <input type="text" id="item_code_row_input_<?php echo $_POST['row_num'];?>" name="item_code_row_input_<?php echo $_POST['row_num'];?>" row_num="<?php echo $_POST['row_num'];?>" class="autocomplte_tags form-control">
      <p id="item_code_row_<?php echo $_POST['row_num'];?>"></p>
    </div>
  </td>

  <td class="item_name_bill">
    <p id="item_name_row_<?php echo $_POST['row_num'];?>"></p>
    <input type="hidden" name="item_name_row_input_<?php echo $_POST['row_num'];?>" id="item_name_row_input_<?php echo $_POST['row_num'];?>">
  </td>

  <td class="item_qty_bill">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 text-center">
          <p class="qty_class" id="item_qty_<?php echo $_POST['row_num'];?>" row_num="<?php echo $_POST['row_num'];?>">1</p>
          <input type="hidden" class="form-control qty_input" row_num="<?php echo $_POST['row_num'];?>" id="item_qty_input_<?php echo $_POST['row_num'];?>" value="1" name="item_qty_input_<?php echo $_POST['row_num'];?>">
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 text-right qty_buttons">
          <button class="qty_plus btn-transparent" row_num="<?php echo $_POST['row_num'];?>">
            <i class="fa fa-plus"></i>
          </button>
          <button class="qty_minus btn-transparent" row_num="<?php echo $_POST['row_num'];?>">
            <i class="fa fa-minus" ></i>
          </button>
        </div>
      </div>
    </div>
  </td>

  <td class="text-center">
    <p><span id="item_price_row_<?php echo $_POST['row_num'];?>">0.00</span>&nbsp;&nbsp;INR</p>
    <input type="hidden" id="item_price_row_input_<?php echo $_POST['row_num'];?>" name="item_price_row_input_<?php echo $_POST['row_num'];?>" value="0">
  </td>

  <td class="text-center">
    <input type="hidden" id="item_total_row_input_<?php echo $_POST['row_num'];?>" name="item_total_row_input_<?php echo $_POST['row_num'];?>" value="0">
    <p><span id="item_total_row_<?php echo $_POST['row_num'];?>">0.00</span>&nbsp;&nbsp;INR</p>
  </td>

  <td>
    <div class="delete_row_bill">
      <button class="edit_row_bill btn-transparent" row_num="<?php echo $_POST['row_num'];?>">
        <i class="fa fa-edit y-code"></i>&nbsp;&nbsp;
      </button>
      <button class="delete_row_bill btn-transparent" row_num="<?php echo $_POST['row_num'];?>">
        <i class="fa fa-trash bro-code"></i>
      </button>
    </div>
  </td>

</tr>