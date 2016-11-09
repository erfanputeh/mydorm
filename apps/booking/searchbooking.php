<?php
$status = require('booking_status.php');
require_once ('../../libs/Db.php');
$html = '<thead>
    <tr>
      <th>รหัสนักศึกษา</th>
      <th>ชื่อ-นามสกุล</th>
      <th>วันที่จอง</th>
      <th>เวลาที่จอง</th>
      <th>สถานะการจอง</th>
      <th>จัดการ</th>
    </tr>
</thead>';

$test = "";

if(isset($_GET["s"])){
  $query = $db->prepare("SELECT * FROM booking INNER JOIN dorm ON (booking.dorm_id=dorm.dorm_id)
                         INNER JOIN member_dp ON (booking.member_id=member_dp.member_id)
                         INNER JOIN room ON (booking.room_id=room.room_id)
                         WHERE booking.booking_date like :s");
  $params = array(
  ':s' => "%" . $_GET["s"] . "%"
  );
  try{
    $query->execute($params);

    while ($ss = $query->fetch(PDO::FETCH_OBJ)){
      $html .="<tbody><tr>
        <td>". $ss->student_id ."</td>
        <td>". $ss->name ."  ". $ss->surname ."</td>
        <td>". $ss->booking_date ."</td>
        <td>". $ss->time_booking ."</td>
        <td>". $status[$ss->booking_status]."</td>";
        $html .= "<td>
        <a data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' href='home.php?file=booking/view&id=" . $ss->booking_id . "'>
          <span class='fa fa-eye' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล' href='home.php?file=booking/update&id=" . $ss->booking_id . "'>
          <span class='fa fa-pencil' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='ลบข้อมูล' href='home.php?file=booking/del&id=" . $ss->booking_id . "'>
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
