  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="form-group">
        <label for="item_name">Hotel name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" value="<?=$item['hotel_name'];?>">
      </div>
      <div class="form-group">
        <label for="item_name">Hotel info</label>
        <input type="text" class="form-control" id="info" name="info" aria-describedby="nameHelp" value="<?=$item['hotel_info'];?>">
      </div>
      <div class="form-group">
        <label for="item_code">Hotel address</label>
        <input type="text" class="form-control" id="address" name="address" value="<?=$item['hotel_address'];?>">
      </div>
    </div>
  <div class="col-lg-6 col-md-6 col-sm-6">
    <div class="form-group">
      <label for="item_price">Hotel phone</label>
      <input type="text" class="form-control" id="tel" name="tel" value="<?=$item['hotel_phone'];?>">
    </div>
    <div class="form-group">
      <label for="item_price">Mobile phone</label>
      <input type="number" class="form-control" id="mob_phone" name="mob_phone" value="<?=$item['mobile'];?>">
    </div>
    <div class="form-group">
      <label for="item_price">Liscence number</label>
      <input type="text" class="form-control" id="lis_num" name="lis_num" value="<?=$item['hote_liscence'];?>">
    </div>
    <div class="form-group">
      <button  type="submit" class="btn btn-warning">Update</button>
    </div>
  </div>
</div>