<?php

if(isset($_GET['id'])){
  $query = $db->prepare("SELECT * FROM repair INNER JOIN material ON repair.material_id = material.material_id  WHERE  repair.repair_id=:id");
  $query->execute(['id'=>$_GET['id']]);
  if($query->rowCount()>0){
    $data = $query->fetch(PDO::FETCH_OBJ);
    $record=[
      'amount' => $data->amount,
      'detail_repair' => $data->detail_repair,
      'repair_status' => $data->repair_status,
    ];
  }
}


if (isset($_POST['ok'])) {
  // อัพเดตลงฐานข้อมูล
  $query = $db->prepare("UPDATE repair INNER JOIN material ON repair.material_id = material.material_id SET
    amount = :amount,
    repair_status = :repair_status
    WHERE repair.repair_id = :id ;");

  $result = $query->execute([
    "id" => $_GET["id"],
    "amount" => $record['amount'] - $_POST["amount"],
    "repair_status" => $_POST["repair_status"],
  ]);

  if($result){
    echo "<script>
    alert('Successfully');
    window.location = 'home.php?file=repair/index';
    </script>";
  }else{
    echo "<script>
    alert('Save fail! '".$query->errorInfo()[2].");
    </script>";
  }
}
?>

<section class="content">
<div class="box">
  <div class="box-header with-border">
      <h3 class="box-title">แก้ไขการแจ้งซ่อม</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
  </div>

      <form action="" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
        &nbsp;  &nbsp;<tr><a href="javascript:history.back();"> <i class='fa fa-fast-backward '></i></a></tr>

        <div class="form-group">
          <label class="col-sm-3 control-label">จำนวนอุปกรณ์ที่ต้องเปลี่ยน</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="amount" name="amount">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-3 control-label">รายละเอียดการแจ้งซ่อม</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="detail_repair" name="detail_repair" disabled="disabled"
             value="<?=$record['detail_repair']?>"> <!-- input type -->
          </div>
        </div>

          <div class="form-group">
          <label class="col-sm-3 control-label">สถานะห้อง</label>
          <div class="col-sm-8">
            <div class="btn-group" data-toggle="buttons">

              <label class="btn btn-primary <?php if ($record['repair_status']==1){ echo "active";} ?>">
                <input type="radio" name="repair_status" value="1" <?php if ($record['repair_status']==1){ echo "checked";} ?> > &nbsp; ซ่อมแล้ว &nbsp;
              </label>

              <label class="btn btn-primary <?php if ($record['repair_status']==2){ echo "active";} ?>">
                <input type="radio" name="repair_status" value="2" <?php if ($record['repair_status']==2){ echo "checked";} ?> > ยังไม่ดำเนินการ &nbsp;
              </label>

              <label class="btn btn-primary <?php if ($record['repair_status']==2){ echo "active";} ?>">
                <input type="radio" name="repair_status" value="3" <?php if ($record['repair_status']==3){ echo "checked";} ?> > กำลังซ่อม &nbsp;
              </label>

            </div>
          </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
          <div style="text-align:center;">
            <button type="submit" class="btn btn-success" name="ok">Submit</button>
            <button type="reset" class="btn btn-default">Clear</button>
          </div>
        </div>
        <br>

      </form>
  </div>
</section>
