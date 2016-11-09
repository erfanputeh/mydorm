
<script type="text/javascript">
  function search(val) {
    $.ajax({url: "activity/searchactivity.php?s="+val, success: function (result){
       $("#search_data").html(result);
    }});
  }
</script>

<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <a href="home.php?file=activity/add"><i class='fa fa-plus-circle'></i></a>&nbsp;
              <h3 class="box-title"><b>กิจกรรมหอพัก</b></h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>

          <!-- /.box-header -->
          <div class="box-body">
              <table class="table table-bordered table-hover" id="search_data">
                  <input type="search" onkeyup="search(this.value)" class="col-md-2 col-md-offset-10" placeholder="Search Dorm" aria-controls="" autofocus> <br><br>
              <tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>
              <tr>
                <th ><div align="center">ลำดับ<div></th>
                <th><div align="center">หอพัก<div></th>
                <th><div align="center">ชื่อกิจกรรม<div></th>
                <th><div align="center">รายละเอียดกิจกรรม<div></th>
                <th><div align="center">จัดการ<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM activity INNER JOIN dorm ON activity.dorm_id=dorm.dorm_id");//เตรียมคำสั่ง sql
                  $query->execute();

                  if($query->rowCount()>0){

                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    ?>
                    <center><tr>
                      <td align="center"><?=($k+1)?></td>
                      <td align="center"><?=$row->dorm_name?></td>
                      <td align=""><?=$row->activity_name?></td>
                      <td align=""><?=$row->detail_activity?></td>
                      <td align="center" width="10%">
                        &nbsp;<a href="home.php?file=activity/view&id=<?=$row->activity_id?>"><i class='fa fa-eye'></i></a>&nbsp;
                        <a href="home.php?file=activity/update&id=<?=$row->activity_id?>"><i class='fa fa-pencil'></i></a>&nbsp;
                        <a href="home.php?file=activity/del&id=<?=$row->activity_id?>"><i class='fa fa-trash'></i></a>
                      </td>

                    </tr></center>
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
