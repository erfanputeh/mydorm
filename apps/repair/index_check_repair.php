<?php
$query = $db->prepare("SELECT * FROM dorm");//เตรียมคำสั่ง sql
$query->execute();
$dorm = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!-- <section class="content">
<div class="box">
  <div class="box-header with-border">
      <h3 class="box-title">Repair</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
  </div>

      <form action="" method="post" role="form" class="form-horizontal" >
        &nbsp;  &nbsp;<tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>

      <center><h6><b>Detail Check Repair</b></h6></center><br>

      <center>
        <div class="form-group">
          <label class="col-sm-2 control-label">Check Repair </label>
          <div class="col-sm-8">
            <div class="btn-group" data-toggle="buttons">
              <?php foreach ($dorm as $key => $value):?>
            <a href="home.php?file=repair/check_repair&id=<?=$value->dorm_id?>">
              <button class="btn btn-primary">
                <?=$value->dorm_name?>
              </button>
            </a>
            <?php endforeach; ?>
            </div>
          </div>
        </div>
      </center>

        <div class="ln_solid"></div>
        <br>

      </form>
  </div>
</section> -->
<section class="content">
<form class="" action="" method="post">
  <label class="">เช็คการแจ้งซ่อม</label> <br>
  <?php foreach ($dorm as $key => $value):?>
  <a href="home.php?file=repair/check_repair&id=<?=$value->dorm_id?>">
    <label class="btn btn-primary">
    <?=$value->dorm_name?>
    </label>
  </a>
  <?php endforeach; ?>
</form>
</section>
