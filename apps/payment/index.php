<?php
$status = require('payment_status.php');
$a=1;
 ?>

 <script type="text/javascript">
   function search(val) {
     $.ajax({url: "payment/searchpayment.php?s="+val, success: function (result){
        $("#search_data").html(result);
     }});
   }
 </script>

<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title"><b>รายการชำระเงินค่าหอพัก</b></h3>

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
                <input type="date" onkeyup="search(this.value)" class="col-md-2 col-md-offset-10" placeholder="Search Date" aria-controls="" autofocus> <br><br><br>
              <tr>
                <th><div align="center">ลำดับ<div></th>
                <th><div align="center">รหัสนักศึกษา<div></th>
                <th><div align="center">ชื่อ-สกุล<div></th>
                <th><div align="center">วันที่ชำระเงิน<div></th>
                <th><div align="center">เวลาที่ชำระเงิน<div></th>
                <th><div align="center">สถานะการชำระเงิน<div></th>
                <th><div align="center">จัดการ<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM payment INNER JOIN member_dp ON payment.member_id=member_dp.member_id ORDER BY payment.payment_date DESC");//เตรียมคำสั่ง sql

                  $query->execute(); //รัน sql

                  if($query->rowCount()>0){ //check data = 0

                   //$data = $query->fetchAll(PDO::FETCH_OBJ); //ดึงข้อมูลมาใส่ใน data
                  //foreach ($data as $k => $row ) {}
                    while ($row = $query->fetch(PDO::FETCH_OBJ)){ //ดึงข้อมูลมาใส่
                      $i=0;
                      $color ='';
                        if($row->payment_status==1){
                          $color='success';
                        }
                        elseif($row->payment_status==2){
                          $color='danger';
                        }
                    ?>
                   <tr>
                      <td align="center"><?=$a++?></td>
                      <td align="center"><?=$row->student_id?></td>
                      <td align="center"><?=$row->name?>&nbsp;&nbsp;&nbsp;<?=$row->surname?></td>
                      <td align="center"><?=$row->payment_date?></td>
                      <td align="center"><?=$row->time_payment?></td>
                      <td align="center"><span class="label label-<?= $color?>"><?= $status[$row->payment_status];?></span></td>
                      <td align="center">
                        &nbsp;<a href="home.php?file=payment/view&id=<?=$row->payment_id?>"><i class='fa fa-eye'></i></a>&nbsp;
                        <a href="home.php?file=payment/update&id=<?=$row->payment_id?>"><i class='fa fa-pencil'></i></a>&nbsp;
                        <a href="home.php?file=payment/del&id=<?=$row->payment_id?>"><i class='fa fa-trash'></i></a>
                      </td>

                    </tr>
                    <?php
                      }//close while
                    }//close if
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
