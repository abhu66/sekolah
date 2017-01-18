<section class="content">
    <div class="box box-default">
      <div class="box-header with-border">
      <h3 class="box-title"><?php echo $title ?> </h3>
        <div class="box-tools pull-right">
         <a class="btn btn-danger" href="<?php echo site_url('admin/employe/add');?>"><i class="fa fa-plus"></i>Tambah</a>
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-chevron-up"></i></button>
          </div>
        </div>
      <div class="box-body">
        <div class="row">
        <div class="col-md-12">
            <div class="form-group">
             <table class="table table-bordered table-hover dataTable_init">
              <thead>
                <tr>
                  <th width="10%">NIK</th>
                  <th>Foto</th>
                  <th>Nama Siswa</th>
                  <th>Kelas</th>
                  <th>Jurusan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody class="tbodies">
               <?php 
               if(count($employe) > 0){
              foreach ($employe as $row) { ?>                
                <tr>
                  <td><?php echo $row['employe_nik'];?></td>
                  <td><?php if(!empty($row['employe_image'])){?>
                    <img src="<?php echo upload_url('employes/'.$row['employe_image']);?>" style="width: 100px;height: 60px;">
                    <?php } else {
                      ?> <img src="<?php echo base_url('media/img/avatar.png'.$row['employe_image']);?>" style="width: 80px;height: 40px;">
                    <?php } ?>  
                  </td>
                  <td><?php echo $row['employe_name'];?></td>
                  <td><?php echo $row['employe_position'];?></td>
                  <td><?php echo $row['employe_status'];?></td>
                  <td><a href="<?php echo site_url('admin/employe/detail/' .$row['employe_id']);?>"><span class="glyphicon glyphicon-eye-open" data-toggle="tooltip" title="view"></span></a>&nbsp;<a class="text-warning" href="<?php echo site_url('admin/employe/edit/'.$row['employe_id']);?>"><span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit"></span></a>&nbsp;
                  <?php if (isset($employe)) :?>
                  <a class="text-warning" href="#delete" data-toggle="modal"><span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete"></span></a>
                <?php endif;?>
                  </td>
                </tr>
              </tbody>
              <?php } 
            } 
            ?>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<?php if (isset($employe)) { ?>
    <!-- Delete Confirmation -->
    <div class="modal modal-danger fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><b><span class="fa fa-warning"></span> Konfirmasi Penghapusan</b></h4>
                </div>
                <div class="modal-body">
                    <p>Data yang dipilih akan dihapus oleh sistem apakah anda yakin?</p>
                </div>
                <?php echo form_open('admin/employe/delete/' . $row['employe_id']); ?>
                <div class="modal-footer">
                    <a><button style="float: right;margin-left: 10px" type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button></a>
                    <input type="hidden" name="del_id" value="<?php echo $row['employe_id'] ?>" />
                    <input type="hidden" name="del_name" value="<?php echo $row['employe_name'] ?>" />
                    <button type="submit" class="btn btn-danger"> Ya</button>
                </div>
                <?php echo form_close(); ?>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  <?php } ?>