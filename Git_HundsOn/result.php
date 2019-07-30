<?PHP
//*************************
//課題No.00
//作成日:2019//
//作成者:峯松康二
//クラス:IH-12A-905
//*************************
session_start();

$input = array(
  'title'       => '',
  'user_name'   => '',
  'description' => '',
);
$material = array(
  'staple_food' => '',
  'taste'       => '',
  'smell'       => '',
  'spiciness'   => '',
);
//投稿ボタンを押したとき
if(isset($_POST['contribute'])) {
  foreach($input as $key => $value) {
    $input[$key] = (string)filter_input(INPUT_POST, $key);
  }

}

//カレーの結果受け取り
if(isset($_POST['cook'])) {
  foreach($material as $key => $value) {
    $material[$key] = (string)filter_input(INPUT_POST, $key);
  }

}
//DBから読み込み



require_once './tpl/result.php';