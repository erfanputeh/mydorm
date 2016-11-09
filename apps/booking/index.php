<?php
$status = require('booking_status.php');
 ?>

 <script type="text/javascript">
   function search(val) {
     $.ajax({url: "booking/searchbooking.php?s="+val, success: function (result){
        $("#search_data").html(result);
     }});
   }
 </script>


<section class="content">
  <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><b>รายการจองหอพัก</b></h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>

          <div class="box-body">
            <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
              <table class="table table-bordered table-hover" id="search_data">
                 <input type="date" onkeyup="search(this.value)" class="col-md-2 col-md-offset-10" placeholder="Search Booking" aria-controls="" autofocus> <br><br><br>
              <tr>
                <th><div align="center">ลำดับ<div></th>
                <th><div align="center">รหัสนักศึกษา<div></th>
                <th><div align="center">ชื่อ-นามสกุล<div></th>
                <th><div align="center">วันที่จอง<div></th>
                <th><div align="center">เวลาที่จอง<div></th>
                <th><div align="center">สถานะการจอง<div></th>
                <th><div align="center">จัดการ<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM booking INNER JOIN dorm ON (booking.dorm_id=dorm.dorm_id)
                                         INNER JOIN member_dp ON (booking.member_id=member_dp.member_id)
                                         INNER JOIN room ON (booking.room_id=room.room_id) ORDER BY booking.booking_date DESC ");//เตรียมคำสั่ง sql
                  $query->execute();

                  if($query->rowCount()>0){
                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    ?>
                    <tr>
                      <td align="center"><?=($k+1)?></td>
                      <td align="center"><?=$row->student_id?></td>
                      <td align="center"><?=$row->name?>&nbsp;&nbsp;&nbsp;<?=$row->surname?></td>
                      <td align="center"><?=$row->booking_date?></td>
                      <td align="center"><?=$row->time_booking?></td>
                      <td align="center"><?=$status[$row->booking_status];?></td>
                      <td align="center">
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
        </div>
      </div>
    </div>



  </section>
