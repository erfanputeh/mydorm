<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title">สวัสดิการหอพัก</h3>

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
                <th>รูปสวัสดิการหอพัก</th>
              </tr>


                <tbody>

              <?php
              //echo $_GET['id'];
              //ดึงข้อมูลในส่วนรายละเอียดของห้อง
              $query = $db->prepare("SELECT * FROM benefits WHERE benefits.benefits_id=:id");
              $query->execute(['id'=>$_GET['id']]);//รัน sql
              $row = $query->fetch(PDO::FETCH_OBJ);
              ?>

              <tr>
                <td><img src="../images/benefits/<?=$row->newbenefits_picture?>" alt="" width="250"/></td>
              </tr>

        </tbody>
      </table>
    </div>
  </section>
