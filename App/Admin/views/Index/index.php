<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		p.welcome{
			font-size: 50px;
			text-align: center;
		}
		p.userinfo{
			font-size: 20px;
			text-align: center;
		}
	</style>
</head>
<body>

	<p class="welcome"><?php echo $welcome; ?></p>
	<!--
	<p class="userinfo">用户名：<?php echo $userinfo['username'];?></p>
	<p class="userinfo">年龄：<?php echo $userinfo['age'];?></p>
	<p class="userinfo">性别：<?php if($userinfo['sex']){echo '男';} else {echo '女';}?></p>
	<p class="userinfo">注册时间：<?php echo date('Y-m-d :H:i',$userinfo['add_time']);?></p>
	-->

</body>
</html>