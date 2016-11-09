<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title"><b>หอพัก</b></h3>

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
                <th><div align="center">ลำดับ<div></th>
                <th><div align="center">หอพัก<div></th>
                <th><div align="center">ประเภทหอพัก<div></th>
                <th><div align="center">จัดการ<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM dorm");//เตรียมคำสั่ง sql
                  $query->execute();

                  if($query->rowCount()>0){

                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    ?>
                    <center><tr>
                      <td align="center"><?=($k+1)?></td>
                      <td align="center"><?=$row->dorm_name?></td>
                      <td align="center"><?=$row->dorm_category?></td>

                      <td align="center">
                        &nbsp;<a href="home.php?file=dorm/view&id=<?=$row->dorm_id?>"><i class='fa fa-eye'></i></a>&nbsp;
                        <a href="home.php?file=dorm/update&id=<?=$row->dorm_id?>"><i class='fa fa-pencil'></i></a>&nbsp;
                        <a href="home.php?file=dorm/del&id=<?=$row->dorm_id?>"><i class='fa fa-trash'></i></a>
                      </td>

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
