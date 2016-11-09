<?php
//ดึงข้อมูลหอพักมาแสดง
$query = $db->prepare("SELECT * FROM dorm ");
$query->execute();
$dorm = $query->fetchAll(PDO::FETCH_OBJ);

//print_r($_POST);
if(isset($_POST['save'])){
  $query = $db->prepare('UPDATE dorm SET
    dorm_name = :dorm_name,
    floor_amout = :floor_amout,
    room_amout = :room_amout,
    dorm_category = :dorm_category,
    price =:price
    -- picture =:picture
    WHERE dorm.dorm_id = :id');

  $result = $query->execute([
    'id'=>$_GET['id'],
    'dorm_name'=>$_POST['dorm_name'],
    'floor_amout'=>$_POST['floor_amout'],
    'room_amout'=>$_POST['room_amout'],
    'dorm_category'=>$_POST['dorm_category'],
    'price'=>$_POST['price'],
    // 'picture'=>$_FILES['picture']

  ]);
  if($result){
echo "<script>alert('Success!')
window.location = 'home.php?file=dorm/index';
</script>";
    //header("location: home.php?file=material/index");
  }else{
    echo "<script>alert('Failed!')
    window.location =  echo $query->errorInfo()[2];
    </script>";
    // echo $query->errorInfo()[2];
  }
}$isNewRecord = false;
  if($isNewRecord){
    $record=[
      'dorm_id'=>'',
      'dorm_name'=>'',
      'floor_amout'=>'',
      'room_amout'=>'',
      'dorm_category'=>'',
      'price'=>'',

    ];
  }else{

    $query = $db->prepare("SELECT * FROM dorm WHERE dorm.dorm_id =:id");
    $query->execute(['id'=>$_GET['id']]);
    if($query->rowCount()>0){
      $data = $query->fetch(PDO::FETCH_OBJ);
      $record=[
        'dorm_id'=>$data->dorm_id,
        'dorm_name'=>$data->dorm_name,
        'floor_amout'=>$data->floor_amout,
        'room_amout'=>$data->room_amout,
        'dorm_category'=>$data->dorm_category,
        'price'=>$data->price,
      ];
    }


  }


    // $isNewRecord = false;
    // include("form.php");
?>

<section class="content">
<div class="box">
    <div class="box-header with-border">
            <h3 class="box-title">หอพัก</h3>
          </div>

          <form action="" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
            <div class="box-body">

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">หอพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <select class="form-control"  name="dorm_id">
                    <option>-เลือกหอพัก-</option>
                     <?php foreach ($dorm as $value): ?>
                       <?php
                        $s='';
                       if($record['dorm_id']==$value->dorm_id){
                        // $s='';
                        // $s='+1';
                         $s = 'selected';
                       }
                       ?>
                      <option value="<?=$value->dorm_id?>" <?=$s?>> <?=$value->dorm_name?></option>
                     <?php endforeach; ?>
                </select>
              </div>
            </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">จำนวนชั้น</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="floor_amout" name="floor_amout"
                   placeholder="จำนวนชั้น" value="<?=$data->floor_amout?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">จำนวนห้องพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="room_amout" name="room_amout"
                   placeholder="จำนวนห้อง" value="<?=$data->room_amout?>">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ประเภทหอพัก</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <!-- <select class="form-control" name="dorm_category">
                    <option>select dorm category</option>
                    <option value="<?=$value->dorm_category?>">หอพักชาย</option>
                    <option value="<?=$value->dorm_category?>">หอพักหญิง</option>
                  </select> -->
                  <select class="form-control"  name="dorm_category">
                    <option>-เลือกหอพัก-</option>
                     <?php foreach ($dorm as $value): ?>
                       <?php
                        $s='';
                       if($record['dorm_category']==$value->dorm_category){
                        // $s='';
                        // $s='+1';
                         $s = 'selected';
                       }
                       ?>
                      <option value="<?=$value->dorm_category?>" <?=$s?>> <?=$value->dorm_category?></option>
                     <?php endforeach; ?>
                </select>


                </div>
            </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ราคาหอพัก</label>
                <div class="col-md-7 col-sm-7 col-xs-10">
                  <input type="text" class="form-control" id="price" name="price"
                   placeholder="ราคาหอพัก" value="<?=$data->price?>">
                </div>
              </div>



            </div>
            <!-- /.box-body -->
            <div class="ln_solid"></div>
            <div class="form-group">
              <div style="text-align:center;">
                <button type="submit" class="btn btn-primary" name="save">บันทึก</button>
                <button type="reset" class="btn btn-default">แก้ไข</button>
              </div>
            </div>
            <br>
            <!-- /.box-footer -->
          </form>
        </div>
      </section>
