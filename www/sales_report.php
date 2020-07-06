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
          <div class="col-md-6 col-sm-6 col-lg-6">
            <h1 class="mt-4">Sales report</h1>
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6 text-right mt-4">
            <button class="btn-transparent" id="filter_report"><i class="fa fa-filter" style="font-size: 25px;"></i></button>
          </div>
        </div>

        <?php 
        if(isset($item['not_data'])){
        ?>
        <div class="row mt-4">
          <div class="col-md-12 col-sm-12 col-lg-12">
            <br>
              <div class="alert alert-info">
                <strong>Info !</strong> No reports available
              </div>
            </div>
          </div>

        <?php
        }

        if(isset($item) && !isset($item['not_data'])){
        ?>
        <div class="row mt-4">
          <div class="col-md-12 col-sm-12 col-lg-12 ">
            <div class="row">
              <div class="col-md-2 col-lg-2 col-sm-2"></div>
              <div class="col-md-4">
                <div class="card" animate="animated pulse delay-1s">
                  <div class="card-header logo-b-g w <h3 class="><i class="fa fa-calendar" aria-hidden="true"></i>
                    &nbsp;&nbsp;Total Products saled</div>
                  <div class="card-body box-shadow">
                    <table cellpadding="6">
                      <tr>
                        <td>Today</td>
                        <td>
                          <?php if(isset($item['day']['price'])) { echo $item['day']['qty_selled']; } else{echo '0';}?></td>
                      </tr>
                                          <tr>
                        <td>This month</td>
                        <td>
                          <?php if(isset($item['month']['price'])) { echo $item['month']['qty_selled']; } else{echo '0';}?></td>
                      </tr>
                                          <tr>
                        <td>This year</td>
                        <td><?php if(isset($item['year']['price'])) { echo $item['year']['qty_selled']; } else{echo '0';}?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card" animate="animated pulse delay-1s">
                  <div class="card-header logo-b-g w <h3 class="><i class="fa fa-calendar" aria-hidden="true"></i>
                    &nbsp;&nbsp;How is today? </div>
                  <div class="card-body box-shadow">                    
                    <table cellpadding="6">
                      <tr>
                        <td>Today earned</td>
                        <td><?php if(isset($item['day']['price'])) { echo $item['day']['price']; } else{echo '0';}?></td>
                      </tr>
                                          <tr>
                        <td>This month earned</td>
                        <td>
                          <?php if(isset($item['month']['price'])) { echo $item['month']['price']; } else{echo '0';}?></td>
                      </tr>
                                          <tr>
                        <td>This year earned</td>
                        <td>
                          <?php if(isset($item['year']['price'])) { echo $item['year']['price']; } else{echo '0';}?></td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>  
          </div>

          <div class="col-lg-12 col-sm-12 col-md-12 mt-4">
            <?php 
            $count = 0;
            if(isset($item[0])){
            foreach ($item[0] as $date => $sales_report) {
              ?>
            <div class="accordion" id="accordionExample">
              <div class="card">
                <div class="card-header" id="heading_<?=$count;?>">
                  <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_<?=$count;?>" aria-expanded="true" aria-controls="collapse_<?=$count;?>">
                      <?=$date;?>
                    </button>

                  </h2>
                </div>

                <div id="collapse_<?=$count;?>" class="collapse" aria-labelledby="heading_<?=$count;?>" data-parent="#accordionExample">
                  <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <table class="table">
                        <tr>
                          <th>Item Name</th>
                          <th>Item Qty</th>
                          <th>Item price</th>
                          <th>Item Total</th>
                        </tr>
                        <?php 
                         // print_r($sales_report);
                        foreach ($sales_report as $items => $report) {

                        ?>
                          <tr>
                              <td><?=$report['item_name'];?></td>
                              <td><?=$report['item_qty'];?></td>
                              <td><?=$report['item_price'];?></td>
                              <td><?=$report['item_price_total'];?></td>
                          </tr>
                        <?php

                        }
                        ?>
                        <tfoot>
                          <tr >
                            <th>Total Qty</th>
                            <th><?=$item['total'][$date]['qty'];?></th>
                            <th >Total amount</th>
                            <th><?=$item['total'][$date]['price'];?></th>
                          </tr>
                        </tfoot>
                        
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
             $count++;
          }
          ?>

          </div>

      </div>
      <?php
        }
        }
      ?>
    </div>
  </div>
</body>
<script type="text/javascript">
  $(document).ready(function() {
    $('#filter_report').click(function(event) {
      event.preventDefault();
      $.ajax({
        url: 'url_router.php?class_name=SiteController&function_name=sales_report',
        type: 'POST',
        success : function(response){
          $('#modal_content').html(response);
          $('#mymodal').modal('show');
        }
      }); 
    });
  });
</script>
