
<html>
<head>
    <style>
        body{
            background: url("images/regbg.jpg");
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
  <div class="head_title">
      <form action="RegAction.php" method="post">
          <p><input type="text" name="name" placeholder=" 请输入用户名" class="name" id="border"></p>
          <p><input type="password" name="pass" placeholder=" 请设置密码" class="password" id="border"></p>
          <p><input type="text" name="emil" placeholder=" 请输入邮箱号" class="emil" id="border"></p>
          <p><select class="select" name="sex" id="border">
                 <option value="男">男</option>
                  <option value="女">女</option>
              </select>
          </p>
          <p><input type="submit" value="确定" class="center" id="cent">
              <button type="button" class="reset" id="cent" onclick="javascript:form.reset();">重置</p>
      </form>
  </div>

</body>
</html>
