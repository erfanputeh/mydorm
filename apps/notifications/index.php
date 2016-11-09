<?php
  $status = require('booking/booking_status.php');
 ?>
<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title"><b>การแจ้งเตือน</b></h3>

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
                <th><div align="center">รหัสนักศึกษา<div></th>
                <th><div align="center">ชื่อ-สกุล<div></th>
                <th><div align="center">วันที่แจ้งเตือน<div></th>
                <th><div align="center">สถานะการจอง<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM booking INNER JOIN member_dp ON booking.member_id = member_dp.member_id
                                          WHERE booking.booking_status = 2");//เตรียมคำสั่ง sql
                  $query->execute(); // รัน sql
                  if($query->rowCount()>0){ //ตรวจสอบว่ามีข้อมูลมากกว่า 0

                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                   foreach ($data as $k => $row) {
                   ?>
                    <center><tr>
                      <td width="5%" align="center"><?=($k+1)?></td>
                      <td width="10%" align="center"><?=$row->student_id?></td>
                      <td width="20%" align="center"><?=$row->name?>&nbsp;&nbsp;&nbsp;<?=$row->surname?></td>
                      <td width="10%" align="center"><?=$row->booking_date?></td>
                      <td width="20%" align="center"><?=$status[$row->booking_status];?></td>
                    </tr></center>


                    <?php
                      } //
                    } //if
                  ?>
              </tbody>
            </table>
            <br>
            <center><td>&nbsp;<a href="home.php?file=notifications/add_notifi">&nbsp;
                    <button class="btn btn-success btn-xs">ส่งการแจ้งเตือน</button>
                    </a></td></center>
          </div>
        </div>
      </div>
    </div>
  </section>

<!-- ORDER BY booking_id ASC; -->
