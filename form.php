<?php header("Content-Type: text/html;charset=utf-8" ) ?>
<html>
  <head>
  <title>Personalizd Greeting Form</title>
  </head>
  <!--輸入名字出現歡迎訊息-->

  <body>

    <?php 
      if(!empty($_POST['name']))
      {
      	echo "哈囉, {$_POST['name']}, 歡迎。";
      }
    ?>
    
    <form action="<?php echo $_POST['name']; ?>" method="post"> 
      請輸入您的名字: <input type="text" name="name" />
      <input type="submit" />
    </form>
  </body>
</html>