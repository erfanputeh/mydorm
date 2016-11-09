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

          <div class="box-body">
            <table class="table table-hover">
            <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
              <tr>
                <th></th>
                <th>ชื่อ-นามสกุล</th>
                <th>หอพัก</th>
                <th>ห้องพัก</th>
              </tr>
        <tbody>
              <?php
              //echo $_GET['id'];
              $query = $db->prepare("SELECT * FROM booking INNER JOIN dorm ON (booking.dorm_id=dorm.dorm_id)
                                     INNER JOIN member_dp ON (booking.member_id=member_dp.member_id)
                                     INNER JOIN room ON (booking.room_id=room.room_id)
                                     WHERE booking.booking_id = :id");
              $query->execute(['id'=>$_GET['id']]);//รัน sql
              $row = $query->fetch(PDO::FETCH_OBJ);
              ?>

              <tr>
                <td><img src="../images/user/<?=$row->picture?>" alt="" width="250"/></td>
                <td><?=$row->name?>&nbsp;&nbsp;&nbsp;<?=$row->surname?></td>
                <td><?=$row->dorm_name?></td>
                <td><?=$row->room_name?></td>
              </tr>

        </tbody>
      </table>
    </div>
  </section>
