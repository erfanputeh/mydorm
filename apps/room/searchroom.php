<?php
$status = require('room_status.php');
require_once ('../../libs/Db.php');
$html = '<thead>
    <tr>
      <th>ห้องพัก</th>
      <th>ชั้นหอพัก</th>
      <th>หอพัก</th>
      <th>จำนวนเตียง</th>
      <th>สถานะห้องพัก</th>
      <th>จัดการ</th>
    </tr>
</thead>';

$test = "";

if(isset($_GET["s"])){
  $query = $db->prepare("SELECT * FROM room INNER JOIN dorm ON room.dorm_id=dorm.dorm_id
                        INNER JOIN dorm_detail ON room.floor_id=dorm_detail.dorm_detail_id
                         WHERE dorm.dorm_name like :s");
  $params = array(
  ':s' => "%" . $_GET["s"] . "%"
  );
  try{
    $query->execute($params);

    while ($ss = $query->fetch(PDO::FETCH_OBJ)){
      $html .="<tbody><tr>
        <td>". $ss->room_name ."</td>
        <td>". $ss->floor_name ."</td>
        <td>". $ss->dorm_name ."</td>
        <td>". $ss->amount_bed ."</td>
        <td>". $status[$ss->room_status]."</td>";
        $html .= "<td>
        <a data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' href='home.php?file=room/view&id=" . $ss->room_id . "'>
          <span class='fa fa-eye' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล' href='home.php?file=room/update&id=" . $ss->room_id . "'>
          <span class='fa fa-pencil' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='ลบข้อมูล' href='home.php?file=room/del&id=" . $ss->room_id . "'>
            <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
        </a>
        </td><tr></tbody>";
    }

  } catch (PDOException $e) {
      echo $e->getMessage();
  }

} else {

}
echo $html;
?>
