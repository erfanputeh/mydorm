
<?php
$query = $db->prepare("SELECT * FROM dorm ");//เตรียมคำสั่ง sql
$query->execute();
$dorm = $query->fetchAll(PDO::FETCH_OBJ);
 ?>

<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title">การชำระเงิน</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

          <div class="box-body">
            <table class="table table-hover">
              <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
              <tr>
                <th>สลิป</th>
                <th>หอพัก</th>
                <th>ชั้น</th>
                <th>ห้องพัก</th>
              </tr>


        <tbody>
              <?php
              $query = $db->prepare("SELECT * FROM payment INNER JOIN booking ON payment.booking_id = booking.booking_id
                                                           INNER JOIN dorm ON booking.dorm_id = dorm.dorm_id
                                                           INNER JOIN floor ON booking.floor_id = floor.floor_id
                                                           INNER JOIN room ON booking.room_id = room.room_id
                                                           INNER JOIN member_dp ON payment.member_id = member_dp.member_id
                                                           WHERE payment.payment_id = :id");
              $query->execute(['id'=>$_GET['id']]);//รัน sql
                $data = $query->fetch(PDO::FETCH_OBJ);
              ?>

              <tr>
                <td><img src="../images/slip/<?=$data->slip?>" alt="" width="250"/></td>
                <td><?=$data->dorm_name?></td>
                <td><?=$data->floor_name?></td>
                <td><?=$data->room_name?></td>
              </tr>
        </tbody>
      </table>
    </div>
  </section>
