<div class="modal-header">
  <h5 class="modal-title" >Add new item</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="form" method="post" action="url_router.php?class_name=TopFormDB&function_name=insert_items">
  	<input type="hidden" name="insert_update" value="insert">
  <div class="form-group">
    <label for="item_name">Product name</label>
    <input type="text" class="form-control" id="item_name" name="item_name" aria-describedby="nameHelp" placeholder="Enter the product name" value="">
  </div>
  <div class="form-group">
    <label for="item_code">Item code</label>
    <input type="text" class="form-control" id="item_code" name="item_code" placeholder="Enter item code">
  </div>
  <div class="form-group">
    <label for="item_price">Item Price</label>
    <input type="text" class="form-control" id="item_price" name="item_price" placeholder="Enter item price">
  </div>
</form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary" id="submit_form">Add new item</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<script type="text/javascript">
  $('#submit_form').click(function(event) {
    event.preventDefault()
    $('#form').submit()
  });
</script>