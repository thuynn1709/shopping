<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="col-xs-3">
                    <button style="width: 150px" type="button" class="btn btn-block btn-primary">Thêm mới</button>  
                </div>
            </div>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách menu</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
                 
              </div>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Tên menu</th>
                  <th>Ngày tạo</th>
                  <th>Ưu tiên</th>
                  <th>Trạng thái</th>
                  <th>Action</th>
                </tr>
                
                <?php 
                    if (!empty($results)) {
                        $stt = 1;
                      
                        foreach ($results as $rs) {
                    ?> 
                    <tr>
                      <td><?php echo $stt; ?></td>
                      <td><?php echo $rs->name; ?></td>
                      <td><?php echo $rs->created; ?></td>
                      <td><?php echo $rs->priority; ?></td>
                      <?php 
                        if ($rs->status == 1) {
                        ?> 
                      <td><span class="label label-success">Hiển thị</span></td>
                        <?php } else {  ?> 
                      <td><span class="label label-danger">Không hiển thị</span></td>
                      <?php } ?> 
                      <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-info">Sửa</button>
                            <button type="button" class="btn btn-warning">Xóa</button>
                        </div>  
                        
                      </td>
                    </tr>
                        <?php 
                        $stt += 1;
                        }
                    }?> 
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <?php echo $links; ?>
              </ul>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    
  </div>


