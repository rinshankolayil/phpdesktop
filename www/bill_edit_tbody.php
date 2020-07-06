<?php
$count = 1;
foreach ($item[1] as $key => $item) {
  
?>
<tr id="row_<?=$count;?>">
  <input type="hidden" name="delete_row_<?=$count;?>" id="delete_row_<?=$count;?>" value="0">
  <td class="sl_no"><?=$count;?></td>

  <td class="item_code_bill">
    <div class="ui-widget">
      <input type="text" id="item_code_row_input_<?=$count;?>" name="item_code_row_input_<?=$count;?>" row_num="<?=$count;?>" class="autocomplte_tags form-control" style="display: none;" value="<?php echo $item['item_name'] .' - ' .$item['item_code'];?>">
      <p id="item_code_row_<?=$count;?>" class="d-b"><?=$item['item_code']?></p>
    </div>
  </td>

  <td class="item_name_bill">
    <p id="item_name_row_<?=$count;?>"><?=$item['item_name']?></p>
    <input type="hidden" name="item_name_row_input_<?=$count;?>" id="item_name_row_input_<?=$count;?>" value="<?=$item['item_name']?>">
  </td>

  <td class="item_qty_bill">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6 text-center">
          <p class="qty_class" id="item_qty_<?=$count;?>" row_num="<?=$count;?>"><?=$item['qty_item']?></p>
          <input type="hidden" class="form-control qty_input" row_num="<?=$count;?>" id="item_qty_input_<?=$count;?>" value="<?=$item['qty_item']?>" name="item_qty_input_<?=$count;?>">
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6 text-right qty_buttons">
          <button class="qty_plus btn-transparent" row_num="<?=$count;?>">
            <i class="fa fa-plus"></i>
          </button>
          <button class="qty_minus btn-transparent" row_num="<?=$count;?>">
            <i class="fa fa-minus" ></i>
          </button>
        </div>
      </div>
    </div>
  </td>

  <td class="text-center">
    <p><span id="item_price_row_<?=$count;?>"><?=$item['item_price']?></span>&nbsp;&nbsp;INR</p>
    <input type="hidden" id="item_price_row_input_<?=$count;?>" name="item_price_row_input_<?=$count;?>" value="<?=$item['item_price']?>">
  </td>

  <td class="text-center">
    <input type="hidden" id="item_total_row_input_<?=$count;?>" name="item_total_row_input_<?=$count;?>" value="<?=$item['total_price_row']?>">
    <p><span id="item_total_row_<?=$count;?>"><?=$item['total_price_row']?></span>&nbsp;&nbsp;INR</p>
  </td>

  <td>
    <div class="delete_row_bill">
      <button class="edit_row_bill btn-transparent" row_num="<?=$count;?>">
        <i class="fa fa-edit y-code"></i>&nbsp;&nbsp;
      </button>
      <button class="delete_row_bill btn-transparent" row_num="<?=$count;?>">
        <i class="fa fa-trash bro-code"></i>
      </button>
    </div>
  </td>

</tr>
<?php
$count++;
}
?>