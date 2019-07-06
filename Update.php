<html>
<head>
    <style>
        body{
            background: url("images/update .jpg");
        }

        .heg-wit{
            background-color: #f4ffe8;
            width: 500px;
            height: 500px;
            border-style: solid;
            margin-top: 100px;
            margin-left: 750px;
            border-color: #f4ffe8;
            opacity: 0.7;
            border-radius: 12px;
        }
        #cent:hover{
            background-color: pink;
        }
        #border:hover{
            border-color:red;
        }
    </style>
    <link rel="stylesheet" href="RegInit.css">
</head>
<body>
<div class="heg-wit">
    <form action="UpdateAction.php" method="post">
        <p><input type="text" name="emil" placeholder=" 请输入邮箱号" class="name" id="border"></p>
        <p><input type="password" name="pass" placeholder=" 请设置新密码" class="emil" id="border"></p>
        <p><input type="password" name="repass" placeholder=" 请确认密码" class="password" id="border"></p>
        </p>
        <p><input type="submit" value="确定" class="center" id="cent">
            <button type="button" class="reset" id="cent" onclick="javascript:form.reset();">重置</p>
    </form>
</div>

</body>
</html>