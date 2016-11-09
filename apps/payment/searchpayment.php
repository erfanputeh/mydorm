<?php
$status = require('payment_status.php');
require_once ('../../libs/Db.php');
$html = '<thead>
    <tr>
      <th width="10%" align="center">รหัสนักศึกษา</th>
      <th width="15%" align="center">ชื่อ-นามสกุล</th>
      <th width="10%" align="center">วันที่ชำระเงิน</th>
      <th width="10%" align="center">เวลาที่ชำระเงิน</th>
      <th width="20%" align="center">สถานะการชำระเงิน</th>
      <th width="10%" align="center">จัดการ</th>
    </tr>
</thead>';

$test = "";

if(isset($_GET["s"])){
  $query = $db->prepare("SELECT * FROM payment INNER JOIN member_dp ON payment.member_id=member_dp.member_id
                         WHERE payment.payment_date like :s");
  $params = array(
  ':s' => "%" . $_GET["s"] . "%"
  );
  try{
    $query->execute($params);

    while ($ss = $query->fetch(PDO::FETCH_OBJ)){
      $html .="<tbody><tr>
        <td>". $ss->student_id ."</td>
        <td>". $ss->name ."  ". $ss->surname ."</td>
        <td>". $ss->payment_date ."</td>
        <td>". $ss->time_payment ."</td>
        <td>". $status[$ss->payment_status]."</td>";
        $html .= "<td>
        <a data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' href='home.php?file=payment/view&id=" . $ss->payment_id . "'>
          <span class='fa fa-eye' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล' href='home.php?file=payment/update&id=" . $ss->payment_id . "'>
          <span class='fa fa-pencil' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='ลบข้อมูล' href='home.php?file=payment/del&id=" . $ss->payment_id . "'>
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
