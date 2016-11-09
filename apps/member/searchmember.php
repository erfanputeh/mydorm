<?php
require_once ('../../libs/Db.php');
$html = '<thead>
    <tr>
      <th width="7%" align="center">รหัสนักศึกษา</th>
      <th width="15%"  align="center">ชื่อ-สกุล</th>
      <th width="20%" align="center">อีเมล์</th>
      <th width="10%" align="center">จัดการ</th>
    </tr>
</thead>';

$test = "";

if(isset($_GET["s"])){
  $query = $db->prepare("SELECT * FROM member_dp
                         WHERE member_dp.name like :s AND member_dp.level=2");
  $params = array(
  ':s' => "%" . $_GET["s"] . "%"
  );
  try{
    $query->execute($params);

    while ($ss = $query->fetch(PDO::FETCH_OBJ)){
      $html .="<tbody><tr>
        <td>". $ss->student_id ."</td>
        <td>". $ss->name ."  ". $ss->surname ."</td>
        <td>". $ss->email."</td>";
        $html .= "<td>
        <a data-toggle='tooltip' data-placement='top' title='ดูข้อมูล' href='home.php?file=member/view&id=" . $ss->member_id . "'>
          <span class='fa fa-eye' aria-hidden='true'></span>
        </a>&nbsp;
        <a data-toggle='tooltip' data-placement='top' title='ลบข้อมูล' href='home.php?file=member/del&id=" . $ss->member_id . "'>
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
