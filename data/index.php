<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: X-Requested-With');
mb_http_input("utf-8");
mb_http_output("utf-8");
date_default_timezone_set("PRC");
error_reporting(E_ERROR|E_WARNING);
session_start();

require_once("config.php");
error_reporting(ALL);

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$date = date("Y-m-d H:i:s");
$time = time();


$type = $GET["type"];
$openid = $GET["openid"];
$playid = $GET["playid"];
$token = $GET["token"];


if(!$playid) $playid = time() . rand(111,999);



/*
exitcode:

-1: 已帮过
-2: 已超过5个帮过
-3: 自己目前状态
-5,-6: 跳回首页
-8: 已有好友帮他集齐
-10: 重新授权

*/
function random_value($array, $num=1){
    $values= array_values($array);
	$ret = array();
	for($i=0; count($values)>0 && $i<$num ; $i++) {
		shuffle( $values );
		array_push( $ret, array_pop($values) );
	}
    return $ret;
}



function getArawd() { 
	$qa = q(" SELECT award, count(*) as a FROM `reg` group by award having award>0 order by award asc ");

	if($qa){
		$a1 = (int)$qa[0]->a;
		$a2 = (int)$qa[1]->a;
		$a3 = (int)$qa[2]->a;
		$a4 = (int)$qa[3]->a;
		$a4 = (int)$qa[4]->a;
		$a4 = (int)$qa[5]->a;
		
		$r1 = 80-$a1;
		$r2 = 40-$a2;
		$r3 = 30-$a3;
		$r4 = 10-$a4;
		
		
		$A1 = $r1>0? array_fill(0,$r1, 1) : array();
		$A2 = $r2>0? array_fill(0,$r2, 2) : array();
		$A3 = $r3>0? array_fill(0,$r3, 3) : array();
		$A4 = $r4>0? array_fill(0,$r4, 4) : array();
		
		
		$R = array_merge($A1, $A2,$A3,$A4);

		return (int)reset(random_value($R,1));

	} else {
		return rand(1,4);
	}

}



$gameEnd = 0;

$reg = q1("select count(*) from reg");
$reg = reset($reg) ;
if($reg>=200){
}
$gameEnd = $reg;

$count = q1("select count(*) from `log`");
$count = reset($count) ;

if($type=="play"){
		$gift = array(0,1,2,3,4,5,6,7,8,9);
		$gf = random_value($gift, rand(3,5) );	//rand(1,2)
		$gf = array_values(array_unique($gf)) ;
		$gfString = json_encode($gf );
	$r= q("insert into share (openid,playid, dtime, ip, senderOK) values ( '$openid', '$playid', '$date', '$ip', '$gfString' ) ");
	echo '{"exitcode":-10,"msg":"", "gameEnd":' . $gameEnd . ', "count":' . $count . ',  "playid": ' . $playid . ', "giftlist":['. implode(',', $gf) .'] }';
		exit();
}

if($type=="playbyshare"){

		q("update share set  receiverOK = concat( receiverOK, '$openid".","."' ) where playid='$playid'  ");

	$r= q("select * from share where playid='$playid' ");


	if( $r ){

		$giftlist = $GET["giftlist"];
		$save = $GET["save"];
		if($save){
			$gf = json_decode($giftlist );
			$oldGift = json_decode( $r[0]->senderOK);
			$oldGift = array_merge( $oldGift, $gf) ;
			$oldGift = array_values(array_unique($oldGift));
			$oldGift = json_encode( $oldGift );
			q("update share set  senderOK = '$oldGift' where playid='$playid'  ");
			//echo  ("update share set  senderOK = '$oldGift' where playid='$playid'  ");
			echo "";
			exit();
		}
		
		$gift = array(0,1,2,3,4,5,6,7,8,9);
		$oldGift = json_decode( $r[0]->senderOK);
		 $gift = array_diff($gift,  $oldGift );
		 $gf = random_value($gift, rand(4,6) );
		 $gf = array_values(array_unique($gf)) ;
		$gfString = json_encode( $gf );

		if(count($gf)==0){
			echo '{ "exitcode":-8, "gameEnd":' . $gameEnd . ', "count":' . $count . ',  "nickname":"", "playid":'.$playid.',  "giftlist": '. $gfString .',  "award": '. getArawd() .' }';
		}else{
			echo '{ "exitcode":-10, "gameEnd":' . $gameEnd . ', "count":' . $count . ', "nickname":"", "playid":'.$playid.',  "giftlist": '. $gfString .',  "award": '. getArawd() .' }';
		}
	}
		exit();
}



if($type=="getgiftlist"){
	$r= q("select * from share where playid='$playid' ");

	if( $r ){
		$gfString = $r[0]->senderOK;
		$gf = json_decode($gfString);
		
		if( $r[0]->openid != $openid  ) {	//好友
			if(count($gf)==10){
				echo '{ "exitcode":-8,"gameEnd":' . $gameEnd . ', "count":' . $count . ',  "nickname":"",  "giftlist": '. $gfString .',  "award": '. getArawd() .' }';
				exit();
			}else{
			
				$helpid = $r[0]->receiverOK;
				if(strpos($helpid, $openid) !==false )  {
					echo '{ "exitcode":-1,"gameEnd":' . $gameEnd . ', "count":' . $count . ',  "nickname":"",  "giftlist": '. $gfString .',  "award": '. getArawd() .' }';
					exit();
				} else {
					echo '{ "exitcode":0,"gameEnd":' . $gameEnd . ', "count":' . $count . ',  "nickname":"",  "giftlist": '. $gfString .',  "award": '. getArawd() .' }';
					exit();
				}
			}
			
		}else{						//自己
			
			echo '{ "exitcode":-3,"gameEnd":' . $gameEnd . ', "count":' . $count . ',  "nickname":"",  "giftlist": '. $gfString .',  "award": '. getArawd() .' }';
			exit();
			
		}
	} else{
		echo '{ "exitcode":-5,"gameEnd":' . $gameEnd . ', "count":' . $count . ',  "nickname":"",  "giftlist": '. $r[0]->senderOK .',  "award": '. getArawd() .' }';
		exit();
	}
}



