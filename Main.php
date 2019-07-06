
<?php
include "load.php";
?>
<html>
<head>
    <meta charset="UTF-8">
    <!--    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <link rel="stylesheet" type="text/css" href="htmleaf-demo.css">
    <link rel="stylesheet" type="text/css" href="mainStyle.css">

    <link rel="stylesheet" href="show.css">
    <style>
        #color:hover {
            background-color: #bfba3c;
        }

        li a{  //展示心愿的样式
        float: left;
            margin-left:10px;
        }

        table{
            position: absolute;
            top: 100px;
            left: 60px;
        }

        #container{
            width: 1100px;
            height: 550px;
            /*border: 1px solid red;*/
            position: absolute;
            top: 260px;
            left: 210px;
        }

        .love{
            width: 230px;
            height: 225px;
            /*border: 1px solid red;*/
        }

        .cont{  //心愿的位置
        padding-top: 10px;
            /*border: solid red;*/
            width: 225px;
            height: 105px;
            margin-top: 10px;
        }
        .numbers{
            /*border: solid red;*/
            width: 100px;
            height: 25px;
            margin-top: 35px;
            margin-left: 60px;
        }

    </style>
</head>
<body>
<div class="htmleaf-container">

    <div class="htmleaf-demo center"> </div>
</div>
<div class="left"><div class="right"></div></div>
<div class="down">
    <div class="hope" style="height: 150px;width: 1095px">
        <!--        <div class="hope"></div>-->
        <div class="case" style="margin-top: 60px;margin-left: -160px"> <div class="part1">
                <img src="images/shout.png">
            </div> <div class="part2" id="part2">
                <div id="scroll1"> <ul> <li>
                            不要被别人表现出来的毫不费力所迷惑，你要知道，那些信手拈来的东西，一定有拼尽全力作为支撑。
                        </li> <li>这个世界上，天才好像真的没有那么多。
                        </li> <li>而我希望，自己也可以在别人看不见的地方不动声色的努力，在关键时刻出其不意的傲娇绽放
                        </li> <li>这个年纪我不在将就。</li> </ul>
                </div> <div id="scroll2"></div> </div>
        </div>
        <a href="javascript:showDialog()" class="sty" style="margin-top:110px;
            margin-left: 900px;width:80px;height: 30px;
            float:left;text-decoration:none; font-size: 20px;color:#040306;" id="color">我要许愿</a>
    </div>

    <div>
        <div id="container">
            <?php foreach ($data as $d){?>

                <!--                love展示愿望的大的div-->
                <div class="love" id="a<?php echo $d['id'];?>" <?php echo 'style="background-image: url('.$d['pic'].');
            position: absolute;
            top:'.$d['rtop'].'px;
            left: '.$d['rleft'].'px;"'?> onclick="cli(<?php echo $d['id'];?>)">
                    <div class="numbers">
                        <?php echo "第".$d['id']."条";?>
                    </div>
                    <div class="cont">
                        <?php echo $d['content'];?>
                    </div>
                    <div class="sender">
                        <?php echo $d['user'];?>
                        <?php echo $d['optime'];?>
                    </div>
                </div>
            <?php }?>
        </div>

    </div>

</div>

<form action="LoginAction.php" method="post">
    <div class="ui-mask" id="mask" onselectstart="return false"></div>
    <div class="ui-dialog" id="dialogMove" onselectstart='return false;'>
        <div class="ui-dialog-title" id="dialogDrag"  onselectstart="return false;" >
            登陆
            <a class="ui-dialog-closebutton" href="javascript:hideDialog();"></a>
        </div>
        <div class="ui-dialog-content">
            <div class="ui-dialog-l40 ui-dialog-pt15">
                <input class="ui-dialog-input ui-dialog-input-username"
                       name="username"
                       type="input" placeholder=" 用户名"/>
            </div>
            <div class="ui-dialog-l40 ui-dialog-pt15">
                <input class="ui-dialog-input ui-dialog-input-password"
                       name="password"
                       type="password" placeholder=" 密码" />
            </div>
            <div class="ui-dialog-l40">
                <a href="Update.php">忘记密码</a>
            </div>
            <div>
                <a><input class="ui-dialog-submit" value="登录" type="submit"></a>
            </div>
            <div class="ui-dialog-l40">
                <a href="Register.php">立即注册</a>
            </div>
        </div>
    </div>
</form>


<!--// js的函数方法都写在了下面的位置上了-->
<!--// 有关于登陆框样式的-->
<!--// 有关于轮转文字的设置-->
<!--// 这里再添加一个加载用户心愿的js-->

<script type="text/javascript">
    var dialogInstace , onMoveStartId;	//	用于记录当前可拖拽的对象

    // var zIndex = 9000;

    //	获取元素对象
    function g(id){return document.getElementById(id);}

    //	自动居中元素（el = Element）
    function autoCenter( el ){
        var bodyW = document.documentElement.clientWidth;
        var bodyH = document.documentElement.clientHeight;

        var elW = el.offsetWidth;
        var elH = el.offsetHeight;

        el.style.left = (bodyW-elW)/2 + 'px';
        el.style.top = (bodyH-elH)/2 + 'px';

    }

    //	自动扩展元素到全部显示区域
    function fillToBody( el ){
        el.style.width  = document.documentElement.clientWidth  +'px';
        el.style.height = document.documentElement.clientHeight + 'px';
    }

    //	Dialog实例化的方法
    function Dialog( dragId , moveId ){

        var instace = {} ;

        instace.dragElement  = g(dragId);	//	允许执行 拖拽操作 的元素
        instace.moveElement  = g(moveId);	//	拖拽操作时，移动的元素

        instace.mouseOffsetLeft = 0;			//	拖拽操作时，移动元素的起始 X 点
        instace.mouseOffsetTop = 0;			//	拖拽操作时，移动元素的起始 Y 点

        instace.dragElement.addEventListener('mousedown',function(e){

            var e = e || window.event;

            dialogInstace = instace;
            instace.mouseOffsetLeft = e.pageX - instace.moveElement.offsetLeft ;
            instace.mouseOffsetTop  = e.pageY - instace.moveElement.offsetTop ;
        })

        return instace;
    }

    //	在页面中侦听 鼠标弹起事件
    document.onmouseup = function(e){

        dialogInstace = false;
        clearInterval(onMoveStartId);

    }

    //	在页面中侦听 鼠标移动事件
    document.onmousemove = function(e) {
        var e = e || window.event;
        var instace = dialogInstace;
        if (instace) {

            var maxX = document.documentElement.clientWidth -  instace.moveElement.offsetWidth;
            var maxY = document.documentElement.clientHeight - instace.moveElement.offsetHeight ;

            instace.moveElement.style.left = Math.min( Math.max( ( e.pageX - instace.mouseOffsetLeft) , 0 ) , maxX) + "px";
            instace.moveElement.style.top  = Math.min( Math.max( ( e.pageY - instace.mouseOffsetTop ) , 0 ) , maxY) + "px";
        }
        if(e.stopPropagation) {
            e.stopPropagation();
        } else {
            e.cancelBubble = true;
        }
    };

    //	拖拽对话框实例对象
    Dialog('dialogDrag','dialogMove');

    function onMoveStart(){

    }


    //	重新调整对话框的位置和遮罩，并且展现
    function showDialog(){
        g('dialogMove').style.display = 'block';
        g('mask').style.display = 'block';
        autoCenter( g('dialogMove') );
        fillToBody( g('mask') );
    }

    //	关闭对话框
    function hideDialog(){
        g('dialogMove').style.display = 'none';
        g('mask').style.display = 'none';
    }
    //	侦听浏览器窗口大小变化
    //window.onresize = showDialog;

    //对于轮转图的修饰
    var PartArea = document.getElementById('part2');
    var Scroll1 = document.getElementById('scroll1');
    var Scroll2 = document.getElementById('scroll2');

    Scroll2.innerHTML = Scroll1.innerHTML;

    function roll() {
        if(Scroll2.offsetHeight - PartArea.scrollTop <= 0) {
            PartArea.scrollTop -= Scroll1.offsetHeight;
        } else {
            PartArea.scrollTop++;
        }
    }

    var StopRoll = setInterval(roll, 60);

    PartArea.onmouseover = function () {
        clearInterval(StopRoll);
    }
    PartArea.onmouseout = function () {
        StopRoll = setInterval(roll, 60);
    }

</script>
</body>
</html>
