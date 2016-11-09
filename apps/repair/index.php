<?php
$status = require('repair_status.php');
 ?>

 <script type="text/javascript">
   function search(val) {
     $.ajax({url: "repair/searchrepair.php?s="+val, success: function (result){
        $("#search_data").html(result);
     }});
   }
 </script>

<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title"><b>รายการแจ้งซ่อม</b></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

          <!-- /.box-header -->
          <div class="box-body ">
            <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
            <table class="table table-bordered table-hover" id="search_data">
              <input type="date" onkeyup="search(this.value)" class="col-md-2 col-md-offset-10" placeholder="Search Date" aria-controls="" autofocus> <br><br><br>
              <tr>
                <th><div align="center">ลำดับ<div></th>
                <th><div align="center">ชื่ออุปกรณ์<div></th>
                <th><div align="center">รายละเอียดการแจ้งซ่อม<div></th>
                <th><div align="center">วันที่แจ้งซ่อม<div></th>
                <th><div align="center">เวลาที่แจ้งซ่อม<div></th>
                <th><div align="center">สถานะการแจ้งซ่อม<div></th>
                <th><div align="center">จัดการ<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM repair
                                        INNER JOIN material ON repair.material_id = material.material_id
                                        ORDER BY repair.dates DESC");//เตรียมคำสั่ง sql
                  $query->execute();

                  if($query->rowCount()>0){

                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    ?>
                   <tr>
                      <td align="center"><?=($k+1)?></td>
                      <td><?=$row->material_name?></td>
                      <td><?=$row->detail_repair?></td>
                      <td align="center"><?=$row->dates?></td>
                      <td align="center"><?=$row->time_repair?></td>
                      <td align="center"><?=$status[$row->repair_status];?></td>

                      <td align="center">
                        &nbsp;<a href="home.php?file=repair/view&id=<?=$row->repair_id?>"><i class='fa fa-eye'></i></a>&nbsp;
                        <a href="home.php?file=repair/update&id=<?=$row->repair_id?>"><i class='fa fa-pencil'></i></a>&nbsp;
                        <a href="home.php?file=repair/del&id=<?=$row->repair_id?>"><i class='fa fa-trash'></i></a>
                      </td>

                    </tr>
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
