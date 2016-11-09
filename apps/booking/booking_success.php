<?php
$status = require('booking_status.php');
 ?>
<section class="content">


  <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">จองหอพัก</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>

          <!-- /.box-header -->
          <div class="box-body">
              <table class="table table-hover">
                <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
              <tr>
                <th>ลำดับ</th>
                <th>รหัสนักศึกษา</th>
                <th>ชื่อ-นามสกุล</th>
                <th>วันที่จอง</th>
                <th>เวลาที่จอง</th>
                <th>จัดการ</th>
              </tr>

              <tbody>
                <!-- SELECT column_name(s)
                FROM table1
                INNER JOIN table2
                ON table1.column_name=table2.column_name;-->

                  <?php
                  $query = $db->prepare("SELECT * FROM booking INNER JOIN dorm ON (booking.dorm_id=dorm.dorm_id)
                                         INNER JOIN member_dp ON (booking.member_id=member_dp.member_id)
                                         INNER JOIN room ON (booking.room_id=room.room_id) ");//เตรียมคำสั่ง sql
                  $query->execute();

                  if($query->rowCount()>0){
                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    ?>
                    <tr>
                      <td><?=($k+1)?></td>
                      <td><?=$row->student_id?></td>
                      <td><?=$row->name?>&nbsp;&nbsp;&nbsp;<?=$row->surname?></td>
                      <td><?=$row->date?></td>
                      <td><?=$status[$row->booking_status];?></td>
                      <td>

                        &nbsp;<a href="home.php?file=booking/view&id=<?=$row->booking_id?>"><i class='fa fa-eye'></i></a>&nbsp;
                        <a href="home.php?file=booking/update&id=<?=$row->booking_id?>"><i class='fa fa-pencil'></i></a>&nbsp;
                        <a href="home.php?file=booking/del&id=<?=$row->booking_id?>"><i class='fa fa-trash'></i></a>
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
