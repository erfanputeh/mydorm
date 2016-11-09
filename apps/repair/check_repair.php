<?php
$status = require('repair_status.php');
$amount = [];
$i = 0;
?>

 <script type="text/javascript">
   function search(val) {
     $.ajax({url: "repair/searchdorm.php?s="+val, success: function (result){
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
          <div class="box-body">
            <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
            <table class="table table-bordered table-hover" id="search_data">
              <!-- <input type="text" onkeyup="search(this.value)" class="col-md-2 col-md-offset-10" placeholder="Search Dorm" aria-controls="" autofocus> <br><br><br>
              <tr> -->
                <th><div align="center">ลำดับ<div></th>
                <th><div align="center">หอพัก<div></th>
                <th><div align="center">ชื่ออุปกรณ์<div></th>
                <th><div align="center">สถานะการแจ้งซ่อม<div></th>
                <th><div align="center">จัดการ<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM repair
                                        INNER JOIN dorm ON (repair.dorm_id = dorm.dorm_id)
                                        INNER JOIN material ON (repair.material_id = material.material_id)
                                        WHERE repair.repair_status=2 AND dorm.dorm_id = :id ");//เตรียมคำสั่ง sql
                  $query->execute([
                    'id' => $_GET['id']
                  ]);

                  if($query->rowCount()>0){

                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    $amount[]=$row->material_name;
                    ?>
                    <center><tr>
                      <td align="center"><?=($k+1)?></td>
                      <td align="center"><?=$row->dorm_name?></td>
                      <td align="center"><?=$row->material_name?></td>
                      <td align="center"><?=$status[$row->repair_status];?></td>

                      <td align="center">
                        &nbsp;<a href="home.php?file=repair/view&id=<?=$row->repair_id?>"><i class='fa fa-eye'></i></a>&nbsp;
                        <a href="home.php?file=repair/update&id=<?=$row->repair_id?>"><i class='fa fa-pencil'></i></a>&nbsp;
                        <a href="home.php?file=repair/del&id=<?=$row->repair_id?>"><i class='fa fa-trash'></i></a>
                      </td>

                    </tr></center>
                    <?php
                      }
                    }
                  ?>
              </tbody>
            </table>
            <?php
            //print_r($amount);
            // echo "<br>";
            // print_r(array_count_values($amount));
            // echo "<br>";
            echo "<br>";
            echo "<b>";
            echo "จำนวนอุปกรณ์ที่ยังไม่ได้ดำเนินการ"; echo "<br>";
            echo "</b>";
            $check_repair = [];
            $check_repair = array_count_values($amount);
            foreach ($check_repair as $key => $value) {
              echo $key;
              echo "  :".$value;
              echo "<br>";
            }
            ?>



          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
  </section>
