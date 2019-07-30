<?php
//*************************
//課題No.01
//作成日:2019/06/06
//作成者:峯松康二
//クラス:IH-12A-905
//*************************


function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}


function redirect($url) {
  header('HTTP/1.1 301 Moved Permanently');
  header("Location: $url");
  exit;
}


// 概要  ：半角英数字から$length文字分ランダムに文字を返す
// 引数  ：int $length (<= 35)
// 戻り値：$length文字分のランダムな半角英数字
function random_string(int $length) {
  if($length > 35) {
    $length = 1;
  }
  $length = 36 - (int)$length;
  return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), $length);
}


function mach_email(string $address) {
  if(filter_var($address, FILTER_VALIDATE_EMAIL)) {
		return true;
  }

  if(strpos($address, '@docomo.ne.jp') !== false || strpos($address, '@ezweb.ne.jp') !== false) {
		$pattern = '/^([a-zA-Z])+([a-zA-Z0-9\._-])*@(docomo\.ne\.jp|ezweb\.ne\.jp)$/';
		if(preg_match($pattern, $address) === 1) {
			return true;
		}
  }

  return false;
}


function wrap_password(string $password) {
  return str_repeat('*', strlen($password));
}

// 概要  ：データベースに接続してSQLを実行する
// 引数1 ：string $sql プリペアドステートメント
// 引数2 ：string/array $data SQL文の条件
// 戻り値：エラー発生時 string
//        参照系 array
//        更新系 bool
function execute_sql(string $sql, ...$data) {
  $rows = array();
  $cnt = 1;
  if(is_array($data[0])){
    $data = array_values($data[0]);  //連想配列を普通の配列に変換
    $cnt = count($data);
  }

  // データ型を生成
  $data_type = substr(gettype($data[0]), 0, 1);
  for($i = 1; $i < $cnt; ++$i){
    $data_type .= substr(gettype($data[$i]), 0, 1);
  }

  $cn = mysqli_connect(HOST, DB_USER, DB_PASS, DB_NAME);

  //接続失敗時エラーコードを返却
  if(mysqli_connect_errno($cn)){
    return $error_code = '201';
  }

  mysqli_set_charset($cn, 'utf8');
  mysqli_begin_transaction($cn);
  try{
    $stmt = mysqli_prepare($cn, $sql);
    if($data[0] !== NULL){
      mysqli_stmt_bind_param($stmt, $data_type, ...$data);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
  }
  catch(Exception $e){
    mysqli_rollback($cn);
    mysqli_close($cn);
    return $error_code = '201';
    // return;
  }
  mysqli_commit($cn);

  if(mysqli_stmt_field_count($stmt)){
    while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
    }
    mysqli_close($cn);
    return $rows;
  }
  mysqli_close($cn);
  return true;
}
