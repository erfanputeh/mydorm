<?php
$status = require('repair_status.php');
require_once ('../../libs/Db.php');
$html = '<thead>
    <tr>
      <th width="7%" align="center">รายละเอียดการแจ้งซ่อม</th>
      <th width="15%" align="center">วันที่แจ้งซ่อม</th>
      <th width="15%" align="center">เวลาที่แจ้งซ่อม</th>
      <th width="10%" align="center">สถานะการแจ้งซ่อม</th>
      <th width="10%" align="center">จัดการ</th>
    </tr>
</thead>';

$test = "";

if(isset($_GET["s"])){
  $query = $db->prepare("SELECT * FROM repair
                         WHERE repair.dates like :s");
  $params = array(
  ':s' => "%" . $_GET["s"] . "%"
  );
  try{
    $query->execute($params);

    while ($ss = $query->fetch(PDO::FETCH_OBJ)){
      $html .="<tbody><tr>
        <td>". $ss->detail_repair ."</td>
        <td>". $ss->dates ."</td>
        <td>". $ss->time_repair ."</td>
        <td>". $status[$ss->repair_status]."</td>";
        $html .= "<td>
        <a data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' href='home.php?file=repair/view&id=" . $ss->repair_id . "'>
          <span class='fa fa-eye' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล' href='home.php?file=repair/update&id=" . $ss->repair_id . "'>
          <span class='fa fa-pencil' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='ลบข้อมูล' href='home.php?file=repair/del&id=" . $ss->repair_id . "'>
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
