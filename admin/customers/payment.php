
<?php 
include("../../config.php");
if(isset($_GET['id'])){
    $user=fetch_array("SELECT * FROM users WHERE id='{$_GET['id']}'");
    if(!$user)die();
}
else if(isset($_POST['balance']) && isset($_POST['id'])){
    $balance=$_POST['balance'];
    $id=intval($_POST['id']);

    if(isset($_GET['is_seller'])){
      @mysqli_query($conn,"UPDATE sellers SET money=money+$balance WHERE id=$id LIMIT 1 ");

    }
    else @mysqli_query($conn,"UPDATE users SET money=money+$balance WHERE id=$id LIMIT 1 ");
    echo "<script>history.back()</script>";
    // @mysqli_query($conn,"INSERT into history_payment(type,name_payment)values('Recharge','')");


}
else die()
?>
<form action="/admin/customers/payment.php" method="POST" class="layui-form" autocomplete="off">
  <div class="modal-header">
    <h5 class="modal-title h6">Cộng tiền người dùng</h5>
    <button type="button" class="close" data-dismiss="modal">
    </button>
  </div>

  <div class="modal-body">
    <input type="hidden" name="_token" value="y6GLNoUX6QPFXFWzrbUF7sCjnd1xGAXu9IP3t90a">    
    <input type="hidden" name="id" readonly="readonly" class="form-control" value="<?=$user['id']?>">
    <div class="form-group row">
      <label class="col-sm-3 col-from-label">Tên tài khoản</label>
      <div class="col-sm-9">
        <input type="text" name="username" required lay-verify="required" readonly="read only" class="form-control" value="<?=$user['full_name']?>">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-sm-3 col-from-label">Email</label>
      <div class="col-sm-9">
        <input type="text" name="email" required lay-verify="required" readonly="readonly" class="form-control" value="<?=$user['email']?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-from-label">Số dư</label>
      <div class="col-sm-9">
        <input type="text" lay-verify="required" readonly="readonly" class="form-control" value="<?=$user['money']?>">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-3 col-from-label">Số tiền nạp</label>
      <div class="col-sm-9">
        <input type="number" name="balance" required lay-verify="required" placeholder="Vui lòng nhập số tiền nạp" autocomplete="new-password" class="form-control">
      </div>
    </div>

  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Pay</button>
    <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
  </div>
</form>