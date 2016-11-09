<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลการแจ้งซ่อม</h3>

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
                <th>รหัสนักศึกษา</th>
                <th>ชื่อ-นามสกุล</th>
                <th>คณะ</th>
                <th>สาขาวิชา</th>
                <th>หอพัก</th>
                <th>ห้องหัก</th>
              </tr>


                <tbody>

              <?php
              //echo $_GET['id'];
              $query = $db->prepare("SELECT * FROM repair INNER JOIN member_dp ON repair.member_id=member_dp.member_id
                                                          INNER JOIN dorm ON repair.dorm_id=dorm.dorm_id
                                                          INNER JOIN room ON repair.room_id=room.room_id WHERE repair.repair_id =:id");
              $query->execute(['id'=>$_GET['id']]);//รัน sql
              $row = $query->fetch(PDO::FETCH_OBJ);
              ?>

              <tr>
                <td><?=$row->student_id?></td>
                <td><?=$row->name?>&nbsp;&nbsp;&nbsp;<?=$row->surname?></td>
                <td><?=$row->faculty?></td>
                <td><?=$row->major?></td>
                <td><?=$row->dorm_name?></td>
                <td><?=$row->room_name?></td>
              </tr>

        </tbody>
      </table>
    </div>
  </section>
