<tr id="row_<?php echo $_POST['row_num'];?>">
  <td class="sl_no">1</td>

  <td class="item_code_bill">
    <div class="ui-widget">
      <input type="text" name="item_code_row_input_1" id="item_code_row_input_1" row_num="1" class="autocomplte_tags form-control">
      <p id="item_code_row_1"></p>
    </div>
  </td>

  <td class="item_name_bill">
    <p id="item_name_row_1"></p>
    <input type="hidden" name="item_name_row_input_1" id="item_name_row_input_1">
  </td>

  <td class="item_qty_bill">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 text-center">
          <p class="qty_class" id="item_qty_1" row_num="1">1</p>
          <input type="hidden" class="form-control qty_input" row_num="1" id="item_qty_input_1" value="1" name="item_qty_input_1">
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 text-right qty_buttons">
          <button class="qty_plus btn-transparent" row_num="1">
            <i class="fa fa-plus"></i>
          </button>
          <button class="qty_minus btn-transparent" row_num="1">
            <i class="fa fa-minus" ></i>
          </button>
        </div>
      </div>
    </div>
  </td>

  <td class="text-center">
    <p><span id="item_price_row_1">0.00</span>&nbsp;&nbsp;INR</p>
    <input type="hidden" id="item_price_row_input_1" value="0">
  </td>

  <td class="text-center">
    <input type="hidden" id="item_total_row_input_1" value="0">
    <p><span id="item_total_row_1">0.00</span>&nbsp;&nbsp;INR</p>
  </td>

  <td>
    <div class="delete_row_bill">
      <button class="edit_row_bill btn-transparent" row_num="1">
        <i class="fa fa-edit y-code"></i>&nbsp;&nbsp;
      </button>
      <button class="delete_row_bill btn-transparent" row_num="1">
        <i class="fa fa-trash bro-code"></i>
      </button>
    </div>
  </td>

</tr>