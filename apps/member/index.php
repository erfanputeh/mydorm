
<script type="text/javascript">
  function search(val) {
    $.ajax({url: "member/searchmember.php?s="+val, success: function (result){
       $("#search_data").html(result);
    }});
  }
</script>

<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">

          <div class="box-header with-border">
              <h3 class="box-title"><b>ข้อมูลสมาชิก</b></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered table-hover" id="search_data">
                <input type="search" onkeyup="search(this.value)" class="col-md-2 col-md-offset-10" placeholder="Search Name" aria-controls="" autofocus> <br><br>
              <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
              <tr>
                <th><div align="center">ลำดับ<div></th>
                <th><div align="center">รหัสนักศึกษา<div></th>
                <th><div align="center">ชื่อ-สกุล<div></th>
                <th><div align="center">อีเมล์<div></th>
                <th><div align="center">จัดการ<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM member_dp WHERE level=2 ");//เตรียมคำสั่ง sql
                  $query->execute();

                  if($query->rowCount()>0){

                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    ?>
                    <tr>
                      <td align="center"><?=($k+1)?></td>
                      <td align="center"><?=$row->student_id?></td>
                      <td align="center"><?=$row->name?>&nbsp;&nbsp;&nbsp;<?=$row->surname?></td>
                      <td align="center"><?=$row->email?></td>
                      <td align="center">
                        &nbsp;&nbsp;<a href="home.php?file=member/view&id=<?=$row->member_id?>"><i class='fa fa-eye'></i></a>&nbsp;
                        <a href="home.php?file=member/del&id=<?=$row->member_id?>"><i class='fa fa-trash'></i></a>
                      </td>
                    </tr>
                    <?php
                      }
                    }
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
