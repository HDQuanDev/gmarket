<?php
include("../../config.php");
if($isAdmin && isset($_POST['id']) ){
    $seller_id=isset($_POST['seller_recharge_request_id'])?$_POST['seller_recharge_request_id']:$_POST['seller_withdraw_request_id'];
    $id=$_POST['id'];

    $pay=fetch_array("SELECT * FROM history_payment WHERE id='{$id}'");

}
else die();

?>

<form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="5hhVUhnDJQDMzznrvw6SAAsK0idqIPZC23C0XmnA">    
    <div class="modal-header">
    	<h5 class="modal-title h6">Pay to seller</h5>
    	<button type="button" class="close" data-dismiss="modal">
    	</button>
    </div>
    <div class="modal-body">

            <input type="hidden" name="shop_id" value="<?=$seller_id?>">
            <input type="hidden" name="payment_method" value="<?=isset($_POST['seller_withdraw_request_id'])?"Withdraw":"Recharge"?>">
            <input type="hidden" name="request_id" value="<?=$_POST['id']?>">
            <div class="form-group row">
                <label class="col-sm-3 col-from-label" for="amount">Requested Amount</label>
                <div class="col-sm-9">
                        <input type="number" lang="en" readonly min="0" step="0.01" name="amount" id="amount" value="<?=$pay['amount']?>" class="form-control" required>
                </div>
            </div>

          <div class="form-group row">
              <label class="col-md-3 col-from-label" for="cancel">Trạng thái</label>
              <div class="col-md-9">
                  <select name="status" id="cancel" class="form-control aiz-selectpicker" required>
                    <option value="Success">Accept</option>
					          <option value="Cancel">Reject</option>
                  </select>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-3 col-from-label">Nội dung</label>
              <div class="col-md-9">
                  <textarea class="form-control" name="reply" style="width:320px;height:100px;"></textarea>
              </div>
          </div>

    </div>
    <div class="modal-footer">
      <button type="submit" name="accept" class="btn btn-primary">Accept</button>
      <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
    </div>
</form>

<script>
$(document).ready(function(){
    $('#payment_option').on('change', function() {
      if ( this.value == 'bank_payment')
      {
        $("#txn_div").show();
      }
      else
      {
        $("#txn_div").hide();
      }
    });
    $("#txn_div").hide();
    AIZ.plugins.bootstrapSelect('refresh');
});
</script>
