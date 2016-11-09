<?php
require_once ('../../libs/Db.php');
$html = '<thead>
    <tr>
      <th width="15%" align="center">ชื่อกิจกรรม</th>
      <th width="7%"  align="center">หอพัก</th>
      <th width="20%" align="center">รายละเอียดกิจกรรม</th>
      <th width="10%" align="center">จัดการ </th>
    </tr>
</thead>';

$test = "";

if(isset($_GET["s"])){
  $query = $db->prepare("SELECT * FROM activity INNER JOIN dorm ON activity.dorm_id=dorm.dorm_id
                         WHERE dorm.dorm_name like :s");
  $params = array(
  ':s' => "%" . $_GET["s"] . "%"
  );
  try{
    $query->execute($params);

    while ($ss = $query->fetch(PDO::FETCH_OBJ)){
      $html .="<tbody><tr>
        <td>". $ss->activity_name ."</td>
        <td>". $ss->dorm_name ."</td>
        <td>". $ss->detail_activity."</td>";
        $html .= "<td>
        <a data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' href='home.php?file=activity/view&id=" . $ss->activity_id . "'>
          <span class='fa fa-eye' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='แก้ไขข้อมูล' href='home.php?file=activity/update&id=" . $ss->activity_id . "'>
          <span class='fa fa-pencil' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='ลบข้อมูล' href='home.php?file=activity/del&id=" . $ss->activity_id . "'>
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
