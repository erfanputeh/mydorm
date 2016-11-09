
<script type="text/javascript">
  function search(val) {
    $.ajax({url: "benefits/searchbenefits.php?s="+val, success: function (result){
       $("#search_data").html(result);
    }});
  }
</script>

<section class="content">
<div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header with-border">
            <a href="home.php?file=benefits/add"><i class='fa fa-plus-circle'></i></a>&nbsp;
              <h3 class="box-title"><b>สวัสดิการหอพัก</b></h3>
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
                <th width="3%"><div align="center">ลำดับ<div></th>
                <th width="10%"><div align="center">สวัสดิการหอพัก<div></th>
                <th width="5%"><div align="center">หอพัก<div></th>
                <th width="10%"><div align="center">ประเภทสวัสดิการหอพัก<div></th>
                <th width="20%"><div align="center">รายละเอียดสวัสดิการหอพัก<div></th>
                <th width="5%"><div align="center">จัดการ<div></th>
              </tr>

              <tbody>
                  <?php
                  $query = $db->prepare("SELECT * FROM benefits INNER JOIN dorm ON benefits.dorm_id=dorm.dorm_id");//เตรียมคำสั่ง sql
                  $query->execute();

                  if($query->rowCount()>0){

                  $data = $query->fetchAll(PDO::FETCH_OBJ);
                  foreach ($data as $k => $row ) {
                    ?>
                    <center><tr>
                      <td align="center"><?=($k+1)?></td>
                      <td align=""><?=$row->benefits_name?></td>
                      <td align="center"><?=$row->dorm_name?></td>
                      <td align="center"><?=$row->benefits_category?></td>
                      <td align=""><?=$row->detail_benefits?></td>
                      <td align="center">
                        &nbsp;<a href="home.php?file=benefits/view&id=<?=$row->benefits_id?>"><i class='fa fa-eye'></i></a>&nbsp;
                        <a href="home.php?file=benefits/update&id=<?=$row->benefits_id?>"><i class='fa fa-pencil'></i></a>&nbsp;
                        <a href="home.php?file=benefits/del&id=<?=$row->benefits_id?>"><i class='fa fa-trash'></i></a>
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
