<?php
require_once "jssdk.php";
$jssdk = new JSSDK("wx4eb7ff7efd54fb54", "983c06169fa72806c94a94c7c28eade3");
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE HTML>
<html>
  <head>
  <meta charset="UTF-8">
  <title>北京丽都维景酒店#拍照抢免单#活动</title>
  <meta name="viewport" content="width=640, user-scalable=no">
  <meta name="apple-mobile-web-app-status-bar-style" content="blank" />
  <meta name="format-detection" content="telephone=no" />

    <style>
    	html,body{
    		height: 100%;
    	}

    	body{min-width: 640px; max-width: 640px;}

      body {
        margin: 0px;
        padding: 0px;
        background: #000 url(images/2-bg.jpg) no-repeat;
      }
      .hide{
      	opacity: 0;
      	position: absolute;
      	left: 100px;
      	top:560px;
      	z-index: 999999;
      }
      #form input{
      	width: 440px;
      	height: 88px;
      	line-height: 88px;
      	border: 1px solid red;
      	background: red;
      }
      #upmsg{
      	display: none;
      	position: absolute;
      	left: 0px;
      	top:560px;
      	width: 100%;
      	text-align: center;
      	color: white;
      	font:28px/88px Arial;
      	z-index: 999999;
      }
      #loading{
      	position: absolute;
      	left: 0px;
      	top:600px;
      	width: 100%;
      	text-align: center;
      	color: white;
      	font:28px/88px Arial;
      	z-index: 999999;
      }
      #cuponMsg{
      	display: none;
      	position: absolute;
      	left: 0px;
      	top:290px;
      	width: 100%;
      	text-align: center;
      	color: white;
      	font:28px/88px Arial;
      	z-index: 999999;
      }
      body, button, input, select, textarea {
        font: 12px/1.5 tahoma, arial, \5b8b\4f53;
        border: 1px solid #ccc;
        border-radius: 3px;
      }
      button, input, select, textarea {
        font-size: 100%;
      }
      .txtpyq {
        display: none;
        text-align: right;
        position: absolute;
        width: 100%;
        right: 0;
        top: 0;
        z-index: 300000000000;
      }
      .bg {
        display: none;
        position: absolute;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.8);
        z-index: 20000000;
      }
      canvas{
      	position: absolute;
      	left:0;
      	top:0;
      	width:100%;
      	height: 100%;
      }
      .phbg{
      	position: absolute;
      }
      img{
      	-webkit-tap-highlight-color: rgba(0,0,0,0);
      }
    </style>
    <script type='text/javascript' src='easeljs-0.8.0.min.js'></script>
    <script type='text/javascript' src='tweenjs-0.6.0.min.js'></script>
    <script type='text/javascript' src='zepto.min.js'></script>
  </head>
  <body>

  <form id="form" class="hide">
  <input name="fileid" type="hidden" value="">
  <input id="sortpicture" type="file" name="sortpic" />
</form>
<img style="display:none" src="images/1-bg.jpg">
<img style="display:none" id="imgPlace">
<div id="cuponMsg">照片仍在上传中...</div>
<div id="loading">加载中，请稍候</div>
<div id="upmsg">后台上传中，可以先开始噢</div>

<canvas id="myCanvas" style="background:none;z-index:10"></canvas>
<canvas id="myCanvas2" style="background:none;z-index:20"></canvas>
<canvas id="myCanvas21" style="background:rgba(0,0,0,0.01);z-index:25"></canvas>
<canvas id="myCanvas22" style="background:rgba(0,0,0,0.01);z-index:26"></canvas>
<canvas id="myCanvas3" style="background:none;z-index:30"></canvas>

<div class="phbg pai2" style="top:0px; left:0; width:640px; z-index:21; display:none;"><img class="" src="images/pai.png"></div>

<div class="phbg result1" style="top:720px; left:0; width:640px; z-index:99999; display:none;"><img class="" src="images/wei.png" height="136" width="640"></div>
<div class="phbg result2" style="top:720px; left:0; width:640px; z-index:99999; display:none;"><img class="" src="images/zhong.png" height="136" width="640"></div>

<div class="phbg regCon" style="background-color:rgba(0,0,0,0.8); width:100%; height:100%; position:fixed; top:0; left:0; z-index: 999999; display:none; ">
			<div id="" class="reg" align="center" style="width: 460px; margin:auto;color: white;padding-top: 50px;">
				<div style="padding: 20px 0; font-size: 28px;font-weight: bold;" class="regTitle">提交你的个人信息以便派发礼品</div>
				<div style="padding: 10px 0;"><span style="padding: 0px 10px;">姓名</span><input type="text" name="name" style="width:240px;"></div>
				<div style="padding: 10px 0;"><span style="padding: 0px 10px;">电话</span><input type="text" name="phone" style="width:240px;"></div>
				<div style="padding: 10px 0;"><span style="padding: 0px 10px;">地址</span><textarea name="address" style="width:240px; vertical-align:top;"></textarea></div>
				<div style="padding: 30px 0;"><img class="regbtn" src="images/btn_ok.png" width="284" height="74" border="0" alt=""></div>
			</div>
</div>

<div class="bg"></div>
<div class="txtpyq"><img src="images/txt_pyq.png" alt=""></div>


<a href="#" class="guanzhu" style="display:none; position:absolute; left:158px;  top:658px; width:280px; height:70px; background:none;z-index: 9999;"></a>
<a href="#" class="chakanyouhui" style="display:none; position:absolute; left:158px;  top:765px; width:280px; height:70px; background:none;z-index: 9999;"></a>
<a href="#" class="tellfriend" style="display:none; position:absolute; left:158px;  top:874px; width:280px; height:70px;z-index: 9999;"></a>

    <script>

var iOS = /(iPad|iPhone|iPod)/g.test( navigator.userAgent );

var theFileName="";
function uperror(msg) {
	msg = msg || "有错误发生，请重试";
	$("#upmsg").text(msg);
	$("#upmsg").click(function(){
		$("#upmsg").hide();
		$("#form").show();
		upload.visible=true;
		stage.update();
	});
}
function upfile() {
	$('[name=fileid]').val(+new Date());
	var ext = ($('#sortpicture').prop('files')[0]).name.split('.').pop();
	if(['jpg','jpeg','png','gif'].indexOf(ext)==-1 ){
		alert(ext+"格式错误,请重新选择.");
		return;
	}

	$("#upmsg").show();
	$("#form").hide();
	uploaded = 1;

	upload.visible=false;
	stage.update();

	theFileName = $('[name=fileid]').val() + "." + ext;
    var file_data = $('#sortpicture').prop('files')[0];   
    var form_data = new FormData();
    form_data.append('fileid', theFileName  );
    form_data.append('file', file_data);
    $.ajax({
                url: 'data/upload.php', // point to server-side PHP script 
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(res){
                    if(!res.error){
                    	localStorage.setItem("lido_may_filename", res.filename);
                    	$('#imgPlace').attr('src', 'uploads/'+res.filename);
                    }else{
                    	uperror( res.error );
                    }
                },
                error:uperror
     });
};
$('#sortpicture').change(upfile)

//global var

var move = 1;

var canvas = document.querySelector("#myCanvas");
canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

var canvas2 = document.querySelector("#myCanvas2");
var canvas21 = document.querySelector("#myCanvas21");
var canvas22 = document.querySelector("#myCanvas22");
canvas2.width = canvas21.width = canvas22.width = window.innerWidth;
canvas2.height =canvas21.height = canvas22.height =  window.innerHeight;

var canvas3 = document.querySelector("#myCanvas3");
canvas3.width = window.innerWidth;
canvas3.height = window.innerHeight;


//init center pos and stage, add background

var stage, bg, bitmap;

stage = new createjs.Stage(canvas);
stage2 = new createjs.Stage(canvas2);
stage3 = new createjs.Stage(canvas3);
stage21 = new createjs.Stage("myCanvas21");
stage22 = new createjs.Stage("myCanvas22");

$(canvas2).hide();
$(canvas3).hide();
$(canvas21).hide();
$(canvas22).hide();


createjs.Touch.enable(stage);
createjs.Touch.disable(stage);
createjs.Touch.enable(stage2);
createjs.Touch.disable(stage2);


var curStage = 1;

bg = new createjs.Bitmap("images/1-bg.jpg");
stage.addChild(bg);

var imgPath=[
'1-begin.png',
'1-up.png',
'2-bg.jpg',
'2-mu.png',
'3-bg.jpg',
'3-q1.png',
'3-q2.png',
'pai.png',
'q1.png',
'q2.png',
'rule.jpg',
'score.png',
'wei.png',
'zhong.png'
 ];
var imgObj={};
imgPath.forEach(function(v){
	var img = new Image();
	img.src = "images/"+v;
	img.onload=function(){
		imgObj[v] = img;

		if( Object.keys(imgObj).length == imgPath.length ){
			$("#loading").hide();
			init();
			//gotoStage3();
		}
	}
});



// add center dot
var shape;

function addClip(path, x,y,w,h){
	
	var shape = new createjs.Shape();
	shape.graphics.drawRect(x,y,w,h);

	var shape2 = new createjs.Shape();
	shape2.graphics.beginFill('#ff0000').drawRect(x,y,w,h);


	var obj = new createjs.Bitmap( imgObj[path] );
	obj.mask = shape;
	obj.hitArea = shape2;
	
	stage.addChild(obj);
	return obj;
}



function imageLoad(img) {
    if (!img.complete) {
        return false;
    }
    if (typeof img.naturalWidth !== "undefined" && img.naturalWidth === 0) {
        return false;
    }
    return true;
}
// add hero bitmap 
var t1;
var cupon;
var begin;
var upload;
var uploadBar;
var uploadBar2;
var scoreData;
var uploaded = 0;

//init 
function init(){

	begin = addClip("1-begin.png", 100, 648 , 440 , 88);
	upload = addClip("1-up.png", 100, 543 , 440 , 88);

	upload.on("click", uploadFile )
	begin.on("click", gotoStage2 )

scoreData = {
	images:[ imgObj['score.png'] ],
	frames:[
		[0,0,131,36],
		[131,0,17,36],
		[148,0,25,36],
		[173,0,24,36],
		[197,0,24,36],
		[221,0,25,36],
		[246,0,24,36],
		[270,0,24,36],
		[294,0,24,36],
		[318,0,25,36],
		[343,0,24,36],
	],
	animations:{
		"S":0,
		"1":1,
		"2":2,
		"3":3,
		"4":4,
		"5":5,
		"6":6,
		"7":7,
		"8":8,
		"9":9,
		"0":10,
	}
}

stage.update();


}



function updateBar (p) {


	stage.removeChild(uploadBar2);
  uploadBar2= stage.addChild( new createjs.Shape(  
		new createjs.Graphics()
		.beginFill("#FF3333")
		.drawRoundRect(200,590, 240*p,22, 11)  ) );

	stage.addChild(uploadBar2);
}

function uploadFile (e) {
	var uploadBar = stage.addChild( new createjs.Shape(  
		new createjs.Graphics()
		.beginFill("#FFFFFF")
		.drawRoundRect(200,590, 240,22, 11)  ) ); 
	e.target.visible = false;
	updateBar(.1);
}

function gotoStage2 (e) {

	$("#upmsg,#form").hide();
	//stage.removeChild(bg, begin, upload);
	$(canvas).hide();
	$(canvas2).show();
	curStage = 2;

	//bg2 = new createjs.Bitmap( imgObj["2-bg.jpg"] );
	canvas2.style.background='url(images/2-bg.jpg)';
	mu2 = new createjs.Bitmap( imgObj["2-mu.png"] );
	pai = new createjs.Bitmap( imgObj["pai.png"] );
	stage2.addChild(mu2, pai);


	if(iOS)
		pai.on("mousedown", clickHandle );
	else{
		pai.visible=false;
		$('.pai2').show();
		$('.pai2').on("mousedown", clickHandle );
	}
	
	runBitmap();
}


//Request Animation Frame
var startTime=new Date();


createjs.Ticker.timingMode = createjs.Ticker.RAF_SYNCHED;
if(!iOS) createjs.Ticker.framerate = 5;
createjs.Ticker.addEventListener("tick", handleTick);


//Handle every tick
function handleTick(event) {

 	if(!clicked && move && t1 && t1._paused ){
 		var d= new Date()-startTime;
 		t1.setPosition( t1.position + d  );
 		startTime = new Date();

 	}

 	if(t1 && t1.position<t1.duration){
	 	if(curStage==1) stage.update();
	 	if(curStage==2) stage2.update();
	 	if(curStage==3) stage3.update();
	 }
}



function runBitmap(){
	mu2.visible = true;
	if( bitmap ) bitmap.visible = false;
	cupon = Math.random()<0.1?1:2;
	bitmap = stage2.addChild( new createjs.Bitmap( imgObj["q"+cupon+".png"] ) ); 

	var b =bitmap.getBounds();

    if(b){
    	bitmap.regX = b.width/2;
    	bitmap.regY = b.height/2;
    	bitmap.x = canvas.width/2;
    	bitmap.y = -500;
    	bitmap.rotation=-70*Math.random();
	}
	
	var prop = iOS?{ y: canvas.height, rotation: 600 } : { y: canvas.height };
	t1 = createjs.Tween.get(bitmap, {paused:true, override:true} ).to(prop, 2500, createjs.Ease.getPowOut(2) ).call(clickHandle);
	if(iOS)t1.setPosition(200);
	startTime= new Date();
}

// click to calc score
var score,  bgMask, scoreBit, snapshot;
var centerPos = {x:320, y:399};
var msgBit, cuponBit,picCon;
var clicked=false;

function clickHandle(e,data) {
	if(!move) return;
	//if(!pai.visible || pai.alpha<1) return;
	if(!mu2.visible)return;
	clicked=true;
	$('.pai2').hide();

	if(!bgMask){
		bgMask = new createjs.Shape(  new createjs.Graphics().beginFill("#000000").drawRect(0, 0, window.innerWidth, window.innerHeight)  );
		bgMask.alpha=0;
		stage2.addChild( bgMask );
	}

	var b =bitmap.getBounds();
	var center = bitmap.localToLocal(b.width/2, b.height/2, stage);
	var dx = center.x-centerPos.x;
	var dy = center.y-centerPos.y;

	var ds = Math.sqrt(Math.pow(dx,2)+Math.pow(dy,2));

	score = Math.max(0, 170-ds);

	move=0;
	createjs.Tween.removeAllTweens();

	saveImage();
}


//save snapshot of the canvas, and display

var bgCanvas = document.createElement('canvas');
bgCanvas.width = 510;
bgCanvas.height = 503;
var bgContext = bgCanvas.getContext('2d');


function saveImage(){

	bgContext.clearRect(0,0,510,503);
	bgContext.drawImage(myCanvas2, // source
	                    71, 149,   // source coordinates
	                    510, 503,   // source dimension
	                    0, 0,       // target coordinates
	                    510, 503);  // target dimensions


	var simg = new Image();
	simg.src= bgCanvas.toDataURL();

	bit = new createjs.Bitmap(simg);
	bit.regX=510/2;
	bit.regY=503/2;
	bit.x = 3+bit.regX;
	bit.y = 3+bit.regY;

	var border = new createjs.Shape( new createjs.Graphics().setStrokeStyle(6).beginStroke("#990000").drawRect(0,0,510+6,503+6) );


	snapshot = new createjs.Container();
	snapshot.addChild(bit,border);
	snapshot.regX=510/2+6;
	snapshot.regY=503/2+6;
	snapshot.x=71-6+snapshot.regX;
	snapshot.y=149-6+snapshot.regY;


	stage2.addChild(snapshot);
	mu2.visible = false;

	
	if(iOS){
		var prop = iOS? {y: snapshot.y-20,rotation:(10-20*Math.random()), scaleX:0.8, scaleY:0.8} : {y: snapshot.y-20, scaleX:0.8, scaleY:0.8};
		t1 = createjs.Tween.get(snapshot).to(prop, 500).call(
			function(){ setTimeout(function(){showScore();},100)     } );
	}else{
		snapshot.y = snapshot.y-20;
		//snapshot.rotation = (10-20*Math.random());
		snapshot.scaleX = snapshot.scaleY = 0.8;
		stage2.update();
		setTimeout(function(){showScore();},100);
	}
	

	if(iOS) createjs.Tween.get(bgMask).to({alpha: 0.3}, 500);

	createjs.Tween.get(bitmap, {override:true}).to({alpha: 0}, iOS?500:0);
	createjs.Tween.get(pai, {override:true}).to({alpha: 0}, iOS?500:0);

	
}

function showScore(){


	if(scoreBit) scoreBit.visible = false;

	scoreSheet = new createjs.SpriteSheet(scoreData);

	scoreBit = new createjs.BitmapText("S"+ ~~score, scoreSheet);
	scoreBit.on("added",function  () {
		var sb=scoreBit.getBounds();
		scoreBit.x = canvas.width/2 - sb.width/2;
		scoreBit.y = 660;

		$(canvas21).show();
		stage21.update();
	});
	stage21.addChild(scoreBit);


	if(msgBit) msgBit.visible = false;
	$(canvas22).show();

	if(score<160){
		msgBit = new createjs.Bitmap( imgObj['wei.png'] );
		msgBit.on("added", function(){ 
			msgBit.y = 720;
			stage22.update();
		});

		if(iOS)
			stage22.addChild(msgBit);
		else
			$('.result1').show();
		//createjs.Tween.get(msgBit).to({alpha: 1}, 0);
		var el = iOS?msgBit:$('.result1 img');
		el.off();
		el.on("mousedown", function(){
			if(iOS && t1&&t1.position<t1.duration)return;
			stage2.removeChild(snapshot);
						
			$(canvas21).hide();
			$(canvas22).hide();
			$('.result1').hide();

			mu2.visible = true;
			
			if(iOS) pai.visible = true;
			else $('.pai2').show();

			pai.alpha = 0;
			createjs.Tween.get(bgMask).to({alpha: 0}, iOS?500:0).call(function(){});
			t1 = createjs.Tween.get(pai).to({alpha: 1}, iOS?500:0).call(function(){
				move=1;
				clicked=false;
				bitmap.alpha=1;
				bitmap.y = -500;
				bitmap.visible = true;
				runBitmap();
			});

		});
	} else{
		msgBit = new createjs.Bitmap( imgObj['zhong.png'] );
		msgBit.on("added", function(){ 
			msgBit.y = 720;
			stage22.update();
		});

		if(iOS)
			stage22.addChild(msgBit);
		else
			$('.result2').show();

		var el = iOS?msgBit:$('.result2 img');
		el.off();
		el.on("mousedown", function(){
			showReg();
		});
	}
}

function gotoStage3(){

	curStage=3;
	$(canvas2).hide();
	$(canvas21).hide();
	$(canvas22).hide();
	$(canvas3).show();
	$('.result2').hide();

	localStorage.setItem("lido_may_score", score);
	localStorage.setItem("lido_may_cupon", cupon);
	
	picCon = new createjs.Container();
	picCon.x=127;
	picCon.y=213;

	bg3 = new createjs.Bitmap( imgObj['3-bg.jpg'] );
	cuponBit = new createjs.Bitmap( imgObj['q'+cupon+'.png'] );
	cuponBit.x=241;
	cuponBit.y=288;
	cuponBit.visible = false;
	
	stage3.addChild(bg3,picCon,cuponBit);
	stage3.update();
	showPic();

	$('.chakanyouhui').show();
	$('.guanzhu').show();
	$('.tellfriend').show();

}

function showPic(){
	if(!uploaded){
		$('#cuponMsg').show().html("您没有上传照片噢");
		return;
	}
	var filename = localStorage.getItem('lido_may_filename');
	if(filename && imageLoad( $('#imgPlace').get(0) ) ) {
		$('#cuponMsg').hide();
		var img=new Image();
		img.onload=function () {
			picLoad = true;
			picBit = new createjs.Bitmap( img );
			picCon.addChild(picBit);
			var r = 246/img.height;
			picBit.scaleX=picBit.scaleY=r;
			var b=picCon.getBounds();
			picCon.x = 320- b.width/2;
			stage3.update();
		}
		img.src= 'uploads/'+filename;
	}else{
		$('#cuponMsg').show();
		setTimeout(function(){showPic()}, 300);
	}
}


var submitting = false;
$('.regbtn').click(function(){
  var s = localStorage.getItem("lido_may_saved");
  if(s=="1"){
	alert("您已提交过信息了。");
	//return;
  }
  if(submitting) return;
  var tel = $.trim( $('input[name=phone]').val() ); //获取手机号
  var address = $.trim( $('[name=address]').val() ); //获取手机号
  
  if( $('input[name=name]').val()=="" || $('input[name=phone]').val()=="" || address=="" ){
	alert("请填写完整信息后提交");return;
  }
	if( ! (/^(0|86|17951)?(1[3-9][0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/).test(tel) && ! (/^１[０１２３４５６７８９]{10}$/).test(tel)  ){
		alert("请填写正确的手机号");return;
	  }
	  submitting = true;
	  $('input[name=name]').attr("disabled","disabled");
	  $('input[name=phone]').attr("disabled","disabled");
	  $('[name=address]').attr("disabled","disabled");
$.post("data/reg.php", {photo: theFileName, award: cupon==1?"名单券":"代金券", name:$('input[name=name]').val(), phone:$('input[name=phone]').val(),  address: address }, function(data){
	if(data>0){
		alert("您的电话已有记录，活动结束后工作人员会尽快联系您");
		return;
	}
	 var date = new Date(); date.setTime(date.getTime() + (999999 * 60 * 1000));
	localStorage.setItem("lido_may_saved", "1");
	alert("恭喜，提交成功。");
	$('.regCon').hide();
		$('input[name=name]').removeAttr("disabled");
	  $('input[name=phone]').removeAttr("disabled");
	  $('[name=address]').removeAttr("disabled");
	  gotoStage3();
});
});
function showReg(){
	$('.regCon').show();
	
}
$('.guanzhu').click(function(e){
	window.location = "http://mp.weixin.qq.com/s?__biz=MjM5NDgxNTgyMQ==&mid=203261420&idx=1&sn=49df2149ee02e1d1ab2cddf7c8927c86#rd";
});

$('.chakanyouhui').click(function(e){
	picCon.visible = false;
	cuponBit.visible = true;
	stage3.update();
	$('#cuponMsg').hide();
});
$('.tellfriend').click(function(e){
	e.preventDefault();
	$(".bg,.txtpyq").show();
});
$(".bg,.txtpyq").click(function  () {
	$(".bg,.txtpyq").hide();
});

    </script>






    <!--script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script-->
    <script type="text/javascript">

    function getUrl (item) {
      var svalue = location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)","i"));
      svalue = svalue ? svalue[1] : svalue;
      if(/openid/i.test(item)){
    	  var s = jQuery.cookie("openid");
    	  if(s){
    		svalue=s;
    	  }else{
    		svalue=+new Date()+Math.round(Math.random()*100);
    		jQuery.cookie("openid", svalue,{path:"/"}); 
    	  }
      }
    	return svalue;
    }

    try{
    	var desc = document.querySelector("meta[name=description]").content;	
    }catch(e){
    	var desc = document.title;
    }


    var urlstr1=window.location.pathname;
    var urlstrtmp=urlstr1.split("/");
    var urlstr="http://"+window.location.host;
    for(var i=0;i<urlstrtmp.length-1;i++){
        urlstr+=urlstrtmp[i]+"/";
    }

    window.imgUrl = 'http://unitedasia.com.cn/p/lido-may/images/wlogo.jpg';
    window.lineLink = 'http://unitedasia.com.cn/p/lido-may/' ;
    window.descContent = "拍闺蜜合影，抢现金烧烤券，我还差1张就可以免费吃了，来帮帮我吧我吧！";
    window.weiboContent = window.descContent;
    window.shareTitle = '嘿！北京丽都维景酒店-拍照抢免单活动开始啦！' ;
    window.appid = '';
    window.isLast=false;


    var winxinBro = navigator.userAgent.match(/MicroMessenger\/([\d.]+)/i);
    var iOS = /iPhone/i.test(navigator.platform) || /iPod/i.test(navigator.platform) || /iPad/i.test(navigator.userAgent);  

    var winxinVer = winxinBro? winxinBro[1] : 0;
    winxinVer = parseFloat(winxinVer);


    if( winxinVer>=6.1) {

    	
    !function(a,b){"function"==typeof define&&(define.amd||define.cmd)?define(function(){return b(a)}):b(a,!0)}(this,function(a,b){function c(b,c,d){a.WeixinJSBridge?WeixinJSBridge.invoke(b,e(c),function(a){h(b,a,d)}):k(b,d)}function d(b,c,d){a.WeixinJSBridge?WeixinJSBridge.on(b,function(a){d&&d.trigger&&d.trigger(a),h(b,a,c)}):d?k(b,d):k(b,c)}function e(a){return a=a||{},a.appId=A.appId,a.verifyAppId=A.appId,a.verifySignType="sha1",a.verifyTimestamp=A.timestamp+"",a.verifyNonceStr=A.nonceStr,a.verifySignature=A.signature,a}function f(a,b){return{scope:b,signType:"sha1",timeStamp:a.timestamp+"",nonceStr:a.nonceStr,addrSign:a.addrSign}}function g(a){return{timeStamp:a.timestamp+"",nonceStr:a.nonceStr,"package":a.package,paySign:a.paySign,signType:a.signType||"SHA1"}}function h(a,b,c){var d,e,f;switch(delete b.err_code,delete b.err_desc,delete b.err_detail,d=b.errMsg,d||(d=b.err_msg,delete b.err_msg,d=i(a,d,c),b.errMsg=d),c=c||{},c._complete&&(c._complete(b),delete c._complete),d=b.errMsg||"",A.debug&&!c.isInnerInvoke&&alert(JSON.stringify(b)),e=d.indexOf(":"),f=d.substring(e+1)){case"ok":c.success&&c.success(b);break;case"cancel":c.cancel&&c.cancel(b);break;default:c.fail&&c.fail(b)}c.complete&&c.complete(b)}function i(a,b){var d,e,f,g;if(b){switch(d=b.indexOf(":"),a){case p.config:e="config";break;case p.openProductSpecificView:e="openProductSpecificView";break;default:e=b.substring(0,d),e=e.replace(/_/g," "),e=e.replace(/\b\w+\b/g,function(a){return a.substring(0,1).toUpperCase()+a.substring(1)}),e=e.substring(0,1).toLowerCase()+e.substring(1),e=e.replace(/ /g,""),-1!=e.indexOf("Wcpay")&&(e=e.replace("Wcpay","WCPay")),f=q[e],f&&(e=f)}g=b.substring(d+1),"confirm"==g&&(g="ok"),-1!=g.indexOf("failed_")&&(g=g.substring(7)),-1!=g.indexOf("fail_")&&(g=g.substring(5)),g=g.replace(/_/g," "),g=g.toLowerCase(),("access denied"==g||"no permission to execute"==g)&&(g="permission denied"),"config"==e&&"function not exist"==g&&(g="ok"),b=e+":"+g}return b}function j(a){var b,c,d,e;if(a){for(b=0,c=a.length;c>b;++b)d=a[b],e=p[d],e&&(a[b]=e);return a}}function k(a,b){if(A.debug&&!b.isInnerInvoke){var c=q[a];c&&(a=c),b&&b._complete&&delete b._complete,console.log('"'+a+'",',b||"")}}function l(){if(!("6.0.2">x||z.systemType<0)){var b=new Image;z.appId=A.appId,z.initTime=y.initEndTime-y.initStartTime,z.preVerifyTime=y.preVerifyEndTime-y.preVerifyStartTime,D.getNetworkType({isInnerInvoke:!0,success:function(a){z.networkType=a.networkType;var c="https://open.weixin.qq.com/sdk/report?v="+z.version+"&o="+z.isPreVerifyOk+"&s="+z.systemType+"&c="+z.clientVersion+"&a="+z.appId+"&n="+z.networkType+"&i="+z.initTime+"&p="+z.preVerifyTime+"&u="+z.url;b.src=c}})}}function m(){return(new Date).getTime()}function n(b){u&&(a.WeixinJSBridge?b():r.addEventListener&&r.addEventListener("WeixinJSBridgeReady",b,!1))}function o(){D.invoke||(D.invoke=function(b,c,d){a.WeixinJSBridge&&WeixinJSBridge.invoke(b,e(c),d)},D.on=function(b,c){a.WeixinJSBridge&&WeixinJSBridge.on(b,c)})}var p,q,r,s,t,u,v,w,x,y,z,A,B,C,D;if(!a.jWeixin)return p={config:"preVerifyJSAPI",onMenuShareTimeline:"menu:share:timeline",onMenuShareAppMessage:"menu:share:appmessage",onMenuShareQQ:"menu:share:qq",onMenuShareWeibo:"menu:share:weiboApp",previewImage:"imagePreview",getLocation:"geoLocation",openProductSpecificView:"openProductViewWithPid",addCard:"batchAddCard",openCard:"batchViewCard",chooseWXPay:"getBrandWCPayRequest"},q=function(){var b,a={};for(b in p)a[p[b]]=b;return a}(),r=a.document,s=r.title,t=navigator.userAgent.toLowerCase(),u=-1!=t.indexOf("micromessenger"),v=-1!=t.indexOf("android"),w=-1!=t.indexOf("iphone")||-1!=t.indexOf("ipad"),x=function(){var a=t.match(/micromessenger\/(\d+\.\d+\.\d+)/)||t.match(/micromessenger\/(\d+\.\d+)/);return a?a[1]:""}(),y={initStartTime:m(),initEndTime:0,preVerifyStartTime:0,preVerifyEndTime:0},z={version:1,appId:"",initTime:0,preVerifyTime:0,networkType:"",isPreVerifyOk:1,systemType:w?1:v?2:-1,clientVersion:x,url:encodeURIComponent(location.href)},A={},B={_completes:[]},C={state:0,res:{}},n(function(){y.initEndTime=m()}),D={config:function(a){A=a,k("config",a),n(function(){c(p.config,{verifyJsApiList:j(A.jsApiList)},function(){B._complete=function(a){y.preVerifyEndTime=m(),C.state=1,C.res=a},B.success=function(){z.isPreVerifyOk=0},B.fail=function(a){B._fail?B._fail(a):C.state=-1};var a=B._completes;return a.push(function(){A.debug||l()}),B.complete=function(b){for(var c=0,d=a.length;d>c;++c)a[c](b);B._completes=[]},B}()),y.preVerifyStartTime=m()}),A.beta&&o()},ready:function(a){0!=C.state?a():(B._completes.push(a),!u&&A.debug&&a())},error:function(a){"6.0.2">x||(-1==C.state?a(C.res):B._fail=a)},checkJsApi:function(a){var b=function(a){var c,d,b=a.checkResult;for(c in b)d=q[c],d&&(b[d]=b[c],delete b[c]);return a};c("checkJsApi",{jsApiList:j(a.jsApiList)},function(){return a._complete=function(a){if(v){var c=a.checkResult;c&&(a.checkResult=JSON.parse(c))}a=b(a)},a}())},onMenuShareTimeline:function(a){d(p.onMenuShareTimeline,{complete:function(){c("shareTimeline",{title:a.title||s,desc:a.title||s,img_url:a.imgUrl,link:a.link||location.href},a)}},a)},onMenuShareAppMessage:function(a){d(p.onMenuShareAppMessage,{complete:function(){c("sendAppMessage",{title:a.title||s,desc:a.desc||"",link:a.link||location.href,img_url:a.imgUrl,type:a.type||"link",data_url:a.dataUrl||""},a)}},a)},onMenuShareQQ:function(a){d(p.onMenuShareQQ,{complete:function(){c("shareQQ",{title:a.title||s,desc:a.desc||"",img_url:a.imgUrl,link:a.link||location.href},a)}},a)},onMenuShareWeibo:function(a){d(p.onMenuShareWeibo,{complete:function(){c("shareWeiboApp",{title:a.title||s,desc:a.desc||"",img_url:a.imgUrl,link:a.link||location.href},a)}},a)},startRecord:function(a){c("startRecord",{},a)},stopRecord:function(a){c("stopRecord",{},a)},onVoiceRecordEnd:function(a){d("onVoiceRecordEnd",a)},playVoice:function(a){c("playVoice",{localId:a.localId},a)},pauseVoice:function(a){c("pauseVoice",{localId:a.localId},a)},stopVoice:function(a){c("stopVoice",{localId:a.localId},a)},onVoicePlayEnd:function(a){d("onVoicePlayEnd",a)},uploadVoice:function(a){c("uploadVoice",{localId:a.localId,isShowProgressTips:0==a.isShowProgressTips?0:1},a)},downloadVoice:function(a){c("downloadVoice",{serverId:a.serverId,isShowProgressTips:0==a.isShowProgressTips?0:1},a)},translateVoice:function(a){c("translateVoice",{localId:a.localId,isShowProgressTips:0==a.isShowProgressTips?0:1},a)},chooseImage:function(a){c("chooseImage",{scene:"1|2"},function(){return a._complete=function(a){if(v){var b=a.localIds;b&&(a.localIds=JSON.parse(b))}},a}())},previewImage:function(a){c(p.previewImage,{current:a.current,urls:a.urls},a)},uploadImage:function(a){c("uploadImage",{localId:a.localId,isShowProgressTips:0==a.isShowProgressTips?0:1},a)},downloadImage:function(a){c("downloadImage",{serverId:a.serverId,isShowProgressTips:0==a.isShowProgressTips?0:1},a)},getNetworkType:function(a){var b=function(a){var c,d,e,b=a.errMsg;if(a.errMsg="getNetworkType:ok",c=a.subtype,delete a.subtype,c)a.networkType=c;else switch(d=b.indexOf(":"),e=b.substring(d+1)){case"wifi":case"edge":case"wwan":a.networkType=e;break;default:a.errMsg="getNetworkType:fail"}return a};c("getNetworkType",{},function(){return a._complete=function(a){a=b(a)},a}())},openLocation:function(a){c("openLocation",{latitude:a.latitude,longitude:a.longitude,name:a.name||"",address:a.address||"",scale:a.scale||28,infoUrl:a.infoUrl||""},a)},getLocation:function(a){c(p.getLocation,function(){var b=f(a,"jsapi_location");return b.type="wgs84",b}(),function(){return a._complete=function(a){delete a.type},a}())},hideOptionMenu:function(a){c("hideOptionMenu",{},a)},showOptionMenu:function(a){c("showOptionMenu",{},a)},closeWindow:function(a){c("closeWindow",{immediate_close:a&&a.immediateClose||0},a)},hideMenuItems:function(a){c("hideMenuItems",{menuList:a.menuList},a)},showMenuItems:function(a){c("showMenuItems",{menuList:a.menuList},a)},hideAllNonBaseMenuItem:function(a){c("hideAllNonBaseMenuItem",{},a)},showAllNonBaseMenuItem:function(a){c("showAllNonBaseMenuItem",{},a)},scanQRCode:function(a){c("scanQRCode",{desc:a.desc,needResult:a.needResult||0,scanType:a.scanType||["qrCode","barCode"]},a)},openProductSpecificView:function(a){c(p.openProductSpecificView,{pid:a.productId,view_type:a.viewType||0},a)},addCard:function(a){var e,f,g,h,b=a.cardList,d=[];for(e=0,f=b.length;f>e;++e)g=b[e],h={card_id:g.cardId,card_ext:g.cardExt},d.push(h);c(p.addCard,{card_list:d},function(){return a._complete=function(a){var c,d,e,b=a.card_list;if(b){for(b=JSON.parse(b),c=0,d=b.length;d>c;++c)e=b[c],e.cardId=e.card_id,e.cardExt=e.card_ext,e.isSuccess=e.is_succ?!0:!1,delete e.card_id,delete e.card_ext,delete e.is_succ;a.cardList=b,delete a.card_list}},a}())},chooseCard:function(a){c("chooseCard",{app_id:A.appId,location_id:a.shopId||"",sign_type:a.signType||"SHA1",card_id:a.cardId||"",card_type:a.cardType||"",card_sign:a.cardSign,time_stamp:a.timestamp+"",nonce_str:a.nonceStr},function(){return a._complete=function(a){a.cardList=a.choose_card_info,delete a.choose_card_info},a}())},openCard:function(a){var e,f,g,h,b=a.cardList,d=[];for(e=0,f=b.length;f>e;++e)g=b[e],h={card_id:g.cardId,code:g.code},d.push(h);c(p.openCard,{card_list:d},a)},chooseWXPay:function(a){c(p.chooseWXPay,g(a),a)}},b&&(a.wx=a.jWeixin=D),D});
    
    	wx.config({
    	    debug: false,
    	    appId: '<?php echo $signPackage["appId"];?>',
    	    timestamp: <?php echo $signPackage["timestamp"];?>,
    	    nonceStr: '<?php echo $signPackage["nonceStr"];?>',
    	    signature: '<?php echo $signPackage["signature"];?>',
    	    jsApiList: [
    	      "onMenuShareTimeline", "onMenuShareAppMessage", "onMenuShareQQ", "onMenuShareWeibo", "startRecord", "stopRecord", "onVoiceRecordEnd", "playVoice", "pauseVoice", "stopVoice", "onVoicePlayEnd", "uploadVoice", "downloadVoice", "chooseImage", "previewImage", "uploadImage", "downloadImage", "translateVoice", "getNetworkType", "openLocation", "getLocation", "hideOptionMenu", "showOptionMenu", "hideMenuItems", "showMenuItems", "hideAllNonBaseMenuItem", "showAllNonBaseMenuItem", "closeWindow", "scanQRCode", "chooseWXPay", "openProductSpecificView", "addCard", "chooseCard", "openCard"
    	    ]
    	  });
    	  wx.ready(function () {
    		
    		wx.onMenuShareAppMessage({
    	      title: window.shareTitle,
    	      desc: window.descContent,
    	      link: window.lineLink,
    	      imgUrl: window.imgUrl,
    	      trigger: function (res) {
    	        
    	      },
    	      success: function (res) {

    	      },
    	      cancel: function (res) {
    	        
    	      },
    	      fail: function (res) {
    	        
    	      }
    	    });
    	
    		wx.onMenuShareTimeline({
    	      title: window.shareTitle,
    	      link: window.lineLink,
    	      imgUrl: window.imgUrl,
    	      trigger: function (res) {
    	        
    	      },
    	      success: function (res) {

    	      },
    	      cancel: function (res) {
    	        
    	      },
    	      fail: function (res) {
    	        
    	      }
    	    });
    	
    	  });
     } else{
    	 
    	 document.write('<script type="text/javascript" src="js/WeixinApi2.js" ><\/script>');
     }


    </script>









    <script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?7aa46bf9a2f2599f2c0fa6109a041b4b";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>



  </body>
</html>
