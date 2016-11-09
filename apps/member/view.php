<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title">ข้อมูลสมาชิก</h3>

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
                <th>รูป</th>
                <th>คณะ</th>
                <th>สาขาวิชา</th>
                <th>อีเมล์</th>
                <th>ที่อยู่</th>
              </tr>


                <tbody>

              <?php
              //echo $_GET['id'];
              $query = $db->prepare("SELECT * FROM member_dp WHERE member_dp.member_id=:id");
              $query->execute(['id'=>$_GET['id']]);//รัน sql
              $row = $query->fetch(PDO::FETCH_OBJ);
              ?>

              <tr>
                <td><img src="../images/user/<?=$row->picture?>" alt="" width="250"/></td>
                <td><?=$row->faculty?></td>
                <td><?=$row->major?></td>
                <td><?=$row->email?></td>
                <td><?=$row->address?></td>
              </tr>

        </tbody>
      </table>
    </div>
  </section>
