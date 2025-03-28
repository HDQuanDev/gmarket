<div class="layui-tab">
  <ul class="layui-tab-title">
    <li class="layui-this">Thêm người dùng mới</li>
  </ul>
</div>
<form action="/admin/customers/add_users.php" method="POST"  class="layui-form" autocomplete="off">
    <input type="hidden" name="_token" value="yMOroPDaxUKBiClNO0m7tokStamfEBIuZmC3udsP">    <div class="layui-form-item">
        <label class="layui-form-label">Tên tài khoản</label>
        <div class="layui-input-inline">
          <input type="text" name="username" required  lay-verify="required" placeholder="Vui lòng nhập tên tài khoản" class="layui-input">
        </div>
      </div>
      
    <div class="layui-form-item">
        <label class="layui-form-label">Email</label>
        <div class="layui-input-inline">
          <input type="text" name="email" required  lay-verify="required" placeholder="Vui lòng nhập email" class="layui-input">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">Mật khẩu</label>
        <div class="layui-input-inline">
          <input type="password" name="password" required lay-verify="required" placeholder="Vui lòng nhập mật khẩu" autocomplete="new-password" class="layui-input">
        </div>
      </div>
      
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn layui-btn-sm" lay-submit lay-filter="formDemo">Xác nhận</button>
          <button type="button" class="layui-btn layui-btn-sm layui-btn-danger" data-dismiss="modal" style="margin-left: 20px;">Hủy</button>
        </div>
      </div>
</form>