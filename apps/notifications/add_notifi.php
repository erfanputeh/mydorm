<?php
if (isset($_POST['ok'])) {

    $query = $db->prepare("SELECT * FROM booking INNER JOIN member_dp ON booking.member_id = member_dp.member_id
                            WHERE booking.booking_status = 2");//เตรียมคำสั่ง sql
    $query->execute(); // รัน sql
    $data = $query->fetchAll(PDO::FETCH_OBJ);
    // echo "<pre>";
    // print_r($data);
    // exit();

    foreach ($data as $value) {
      $query = $db->prepare("INSERT INTO notifications (member_id, booking_id, notifi_date, notifi_status, notifi_text)
                            values(:member_id ,:booking_id ,:notifi_date ,:notifi_status ,:notifi_text)");

      $result = $query->execute([
        "member_id" => $value->member_id,
        "booking_id" => $value->booking_id,
        "notifi_date" =>date("Y-m-d"),
        "notifi_status" =>1,
        "notifi_text" =>$_POST['notifi_text'],
      ]);
    } //foreach

          if ($result) {
            echo "<script>
                    alert('แจ้งเตือนเรียบร้อย')
                    window.location = 'home.php?file=notifications/index';
                  </script>";
          }else {
            echo "<script>
                    alert('ผิดพลาด '".$query->errorInfo()[2].");
                  </script>";

      } // else
}
?>
<section class="content">
<div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">การแจ้งเตือน</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <!-- form start -->

          <form action="" method="post" role="form" class="form-horizontal" >
            <div class="box-body">

              <div class="form-group">
                <label class="control-label col-md-4 col-sm-6 col-xs-16">ข้อความการแจ้งเตือน</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea name="notifi_text" rows="8" cols="40"></textarea>
                </div>
            </div>

            <!-- /.box-body -->
            <div class="ln_solid"></div>
            <div class="form-group">
              <div style="text-align:center;">
                <button type="submit" class="btn btn-primary" name="ok">บันทึก</button>
                <button type="reset" class="btn btn-default">แก้ไข</button>
              </div>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </section>
