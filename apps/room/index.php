<?php
$status = require('room_status.php');
 ?>

 <script type="text/javascript">
   function search(val) {
     $.ajax({url: "room/searchroom.php?s="+val, success: function (result){
        $("#search_data").html(result);
     }});
   }
 </script>


<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
              <h3 class="box-title"><b>ข้อมูลห้องพัก</b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
          </div>

          <div class="box-body">
          <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
              <table class="table table-bordered table-hover" id="search_data">
               <input type="search" onkeyup="search(this.value)" class="col-md-2 col-md-offset-10" placeholder="ค้นหาหอพัก" aria-controls="" autofocus>  <br>

              <tr>
                <th>ลำดับ</th>
                <th>ห้องพัก</th>
                <th>ชั้นหอพัก</th>
                <th>หอพัก</th>
                <th>จำนวนเตียง</th>
                &nbsp;&nbsp;<th>สถานะห้องพัก</th>
                <th>จัดการ</th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM room INNER JOIN dorm ON room.dorm_id=dorm.dorm_id
                                        INNER JOIN dorm_detail ON room.floor_id=dorm_detail.dorm_detail_id");//เตรียมคำสั่ง sql
                  $query->execute();

                  if($query->rowCount()>0){

                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    ?>
                    <center><tr>
                      <td><?=($k+1)?></td>
                      <td><?=$row->room_name?></td>
                      <td><?=$row->floor_name?></td>
                      <td><?=$row->dorm_name?></td>
                      <td><?=$row->amount_bed?></td>
                      <td><?=$status[$row->room_status];?></td>

                      <td>
                        &nbsp;<a href="home.php?file=room/view&id=<?=$row->room_id?>"><i class='fa fa-eye'></i></a>&nbsp;
                        <a href="home.php?file=room/update&id=<?=$row->room_id?>"><i class='fa fa-pencil'></i></a>&nbsp;
                        <a href="home.php?file=room/del&id=<?=$row->room_id?>"><i class='fa fa-trash'></i></a>
                      </td>

                    </tr></center>
                    <?php
                      }
                    }
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
