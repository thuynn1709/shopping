 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Quản lý đơn hàng</a></li>
        <li class="active">Chi tiết đơn hàng</li>
      </ol>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thông tin chi tiết đơn hàng</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/order/detail/'). $item->id ; ?>">
              <div class="box-body">
                <div class="form-group">
                    <label>Thông tin khách hàng</label>
                </div>  
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>Tên</th>
                                <th>Tài khoản email</th>
                                <th>SĐT</th>
                                <th>Địa chỉ ship</th>
                            </tr>
                            <tr>
                                <td><?php echo $user->fullname ; ?></td>
                                <td><?php echo $user->email ; ?></td>
                                <td><?php echo $user->phone ; ?></td>
                                <td><?php echo ($user->address_ship != '') ? $user->address_ship : $user->address ?></td>
                            </tr>
                        </tbody>
                      </table>
                </div>  
                  
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-6">
                            <label>Cách thanh toán</label>
                            <select name="pay_method" class="form-control">
                                <option value="1" <?php echo ($item->pay_status == 1) ? 'selected="selected"' : '' ?>> Tiền mặt</option>
                                <option value="0" <?php echo ($item->pay_status == 0) ? 'selected="selected"' : '' ?>> Chuyển khoản</option> 
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Trạng thái thanh toán</label>
                            <select name="pay_status" class="form-control">
                                <option value="1" <?php echo ($item->pay_status == 1) ? 'selected="selected"' : '' ?>> Đã thanh toán</option>
                                <option value="0" <?php echo ($item->pay_status == 0) ? 'selected="selected"' : '' ?>> Chưa thanh toán</option> 
                            </select>
                        </div>
                    </div>
                </div>
                  
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-4">
                            <label>Tình trạng</label>
                            <select name="status" class="form-control">
                                <option value="1" <?php echo ($item->status == 1) ? 'selected="selected"' : '' ?>> Đã giao hàng</option>
                                <option value="0" <?php echo ($item->status == 0) ? 'selected="selected"' : '' ?>> Chưa giao hàng</option> 
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Tổng số lượng</label>
                            <input type="text" name="amount" id="total_amount" disabled class="form-control" id="exampleInputAmount" value=" <?php echo $item->amount ; ?>" placeholder="000">
                           
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Tổng tiền đơn hàng</label>
                            <input type="text" name="price" id="total_price" disabled class="form-control" id="exampleInputAmount" value=" <?php echo $item->pricetotal ; ?>" placeholder="000">
                        </div>
                        
                    </div>
                </div>
                         
                <div class="box-body table-responsive no-padding">
            <table class="table table-hover" id="table-order-detail">
                <tr>
                  <th>ID</th>
                  <th>Tên sản phẩm</th>
                  <th>Số lượng khách đặt</th>
                  <th>Trong kho còn</th>
                  <th>Tổng tiền</th>
                  <th>Giảm giá( nếu có)</th>
                  <th class="text-center">#</th>
                  
                </tr>
                
                <?php 
                    $offset = 0;
                    if (!empty($results)) {
                        $offset = $offset + 1;
                      
                        foreach ($results as $rs) {
                    ?> 
                    <tr id="order_detail_<?php echo $rs->id; ?>">
                        <td><?php echo $offset; ?></td>
                        <td><?php echo $rs->name; ?></td>
                        <td><input type="text" name="amount_detail" id="amount_detail_<?php echo $rs->id; ?>" class="form-control" id="exampleInputEmail1" value="<?php echo $rs->amount; ?>" placeholder="Số lượng sản phẩm"></td>
                        <td class="text-center"><?php echo $rs->pamount; ?></td>
                        <td class="text-center"><?php echo $rs->price; ?></td>
                        <td><input type="text" name="discount_detail" id="discount_detail_<?php echo $rs->id; ?>" class="form-control" id="exampleInputEmail1" value="<?php echo $rs->discount; ?>" placeholder="Giảm giá nếu có"></td>
                        <td class="pull-right">    
                            <div class="btn-group">
                                <button type="button" data-value="<?php echo $rs->id; ?>" class="btn btn-info">Cập nhật</button>
                                <button type="button" data-value="<?php echo $rs->id; ?>" class="btn btn-warning">Xóa</button>
                            </div>  
                        </td>
                    </tr>
                        <?php 
                        $offset += 1;
                        }
                    }?> 
              </table>
            </div>
                
                  
                
            </div>
              <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <button type="submit" id="cancel" class="btn btn-primary">Hủy bỏ</button>
            </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  

<script src="<?php echo base_url(); ?>public/admin/js/notify.js"></script>

<script>
    $(function () {
        $( "#cancel" ).click(function() {
            window.location.href = '<?php echo base_url(); ?>admin/product/index';
            return false;
        });

        $('.btn-warning').click(function(){
            var r = confirm("Chắc chắn xóa !");
            if (r == true) {
                var order_detail_id = $(this).attr("data-value");
                var tr_id = '#order_detail_' + order_detail_id;
                var order_id = <?php echo $item->id; ?>;
                var url = '<?php echo base_url('admin/order/delete_orderdetail_by_id'); ?>';
                $.ajax
                ({ 
                    url: url,
                    data: {'order_detail_id': order_detail_id, 'order_id' : order_id},
                    type: 'post',
                    success: function(result) {
                        obj = jQuery.parseJSON(result);

                        if ( obj.msg == 'success') {
                            $(tr_id).remove();
                            $('#total_price').val(obj.price);
                            $('#total_amount').val(obj.amount);
                            $("#table-order-detail").notify(
                                "Xóa thành công !", 
                                { position:"top", className: 'success', }
                            );
                        }else {
                             $("#table-order-detail").notify("Xóa không thành công !", "error");
                        }
                    }
                });
            } else {
                txt = "Bạn đã hủy xóa!";
            }
            return false;
        });
        
        
        $('.btn-info').click(function(){
            var r = confirm("Bạn chắc chắn muốn cập nhật !");
            if (r == true) {
                var order_detail_id = $(this).attr("data-value");
                var discount_id = '#discount_detail_' + order_detail_id;
                var amount_id = '#amount_detail_' + order_detail_id;
                var amount = parseInt($(amount_id).val());
                    
                if (! isInt(amount)) {
                    $(amount_id).notify("Số lượng là phải số và > 0 !", "error");
                    return false;
                }
                
                var order_id = <?php echo $item->id; ?>;
                var url = '<?php echo base_url('admin/order/update_cart'); ?>';
                $.ajax
                ({ 
                    url: url,
                    data: {
                           'order_detail_id': order_detail_id, 
                           'order_id' : order_id, 
                           'discount' : $(discount_id).val(), 
                           'amount' : amount
                        },
                    type: 'post',
                    success: function(result) {
                        obj = jQuery.parseJSON(result);

                        if ( obj.msg == 'success') {
                            $('#total_price').val(obj.price);
                            $('#total_amount').val(obj.amount);
                            $(amount_id).notify( "Cập nhật thành công !", { position:"top", className: 'success' });
                        }else {
                            $(amount_id).notify("Cập nhật không thành công !", "error");
                        }
                    }
                });
            } else {
                txt = "Bạn đã hủy xóa!";
            }
            return false;
        });
    })
  
    function isInt(n) {
        return Number(n) === n && n % 1 === 0;
    }
    

</script>
