<style type="text/css">
  #customer_number_form::-webkit-inner-spin-button, 
  #customer_number_form::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
</style>
<div class="modal-header">
  <h5 class="modal-title" >Add customer information</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="form-group">
    <label for="item_name">Customer name &nbsp;&nbsp;<span class="r">*</span></label>
    <input type="text" class="form-control" id="customer_name_form" aria-describedby="nameHelp" placeholder="Enter the customer name" required>
  </div>
  <div class="form-group">
    <label for="item_code">Phone number &nbsp;&nbsp;<span class="r">*</span></label>
    <input type="number" class="form-control" id="customer_number_form" placeholder="Enter phone number" required>
  </div>
  <div class="form-group">
    <label for="item_price">Locations</label>
    <input type="text" class="form-control" id="customer_location_form" placeholder="Enter customer locations">
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary" id="submit_form">Add Customer info</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<script type="text/javascript">
  $(document).ready(function() {

    $('#submit_form').click(function(event) {
      event.preventDefault()
      var cname = $('#customer_name_form').val()
      var cphone = $('#customer_number_form').val()
      var cloc = $('#customer_location_form').val()
      if(!cname){
          $('#customer_name_form').css('border', '1px solid red')
      }
      if(!cphone){
          $('#customer_number_form').css('border', '1px solid red')
      }
      if (cname && cphone){
        $('#customer_name').val(cname)
        $('#customer_number').val(cphone)
        $('#customer_location').val(cloc)
        if($('#total_rows').attr('added') == 1){
          $('#save_bill').prop('disabled',false)
        }
        $('#mymodal').modal('hide')
        
      }
    });
  });
  
</script>