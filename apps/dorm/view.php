<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title">หอพัก</h3>

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
                <th>จำนวนชั้น</th>
                <th>จำนวนห้องพัก</th>
                <th>ราคาหอพัก</th>
              </tr>


                <tbody>

              <?php
              //echo $_GET['id'];
              $query = $db->prepare("SELECT * FROM dorm WHERE dorm.dorm_id=:id");
              $query->execute(['id'=>$_GET['id']]);//รัน sql
              $row = $query->fetch(PDO::FETCH_OBJ);
              ?>

              <tr>
                <td><img src="../images/dorm/<?=$row->pic_dorm?>" alt="" width="250"/></td>
                <td><?=$row->floor_amout?></td>
                <td><?=$row->room_amout?></td>
                <td><?=$row->price?></td>
              </tr>

        </tbody>
      </table>
    </div>
  </section>
