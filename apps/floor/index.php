<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title"><b>ชั้นหอพัก</b></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-hover">
              <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
              <tr>
                <th width="10%"><div align="center">ลำดับ.<div></th>
                <th width="50%"><div align="center">ชั้นหอพัก<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM floor ");//เตรียมคำสั่ง sql
                  $query->execute();

                  if($query->rowCount()>0){

                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    ?>
                    <center><tr>
                      <td align="center"><?=($k+1)?></td>
                      <td align="center"><?=$row->floor_name?></td>
                    </tr></center>
                    <?php
                      }
                    }
                  ?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
