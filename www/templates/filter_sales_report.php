<?php
  date_default_timezone_set('Asia/Kolkata');
  $date = date('Y-m-d H:i:s', time());
  $date_ony = date('Y-m-d', time());
?>
<div class="modal-header">
  <h5 class="modal-title" >Filter sales report</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <form id="form" method="post" action="url_router.php?class_name=SiteController&function_name=sales_report_submit">
    <div class="text-center">
    <div class="form-check-inline">
      <label class="form-check-label">
        <input type="radio" class="form-check-input filter_date" value="date" name="filter_by" checked="checked">By date
      </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label">
        <input type="radio" class="form-check-input filter_date" value="month" name="filter_by">By Months
        
      </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label">
        <input type="radio" class="form-check-input filter_date" value="year" name="filter_by">By Year
      </label>
    </div>
  </div>
  <br>
  <div class="form-group">
    <label for="from_date">From Date</label>
    <input type="text" class="form-control datepicker" id="from_date" name="from_date" aria-describedby="nameHelp" placeholder="Enter from date" value="<?=$date_ony;?>">
  </div>
  <div class="form-group">
    <label for="to_date">To Date</label>
    <input type="text" class="form-control datepicker" id="to_date" name="to_date" aria-describedby="nameHelp" placeholder="Enter to date" value="<?=$date_ony;?>">
  </div>
    <span class="r d-n filter_notes">It will discard the day you choose, only year and month will be applicable</span>
</form>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-primary" id="submit_form">Filter</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
<script type="text/javascript">
  $('#submit_form').click(function(event) {
    event.preventDefault()
    $('#form').submit()
  });
  $('.filter_date').change(function(event) {
    var value = $(this).val();
    if(value !='date'){
      $('.filter_notes').show()
    }
    else{
      $('.filter_notes').hide()
    }
  });
  $(".datepicker").datepicker({
     dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true,
  });

</script>