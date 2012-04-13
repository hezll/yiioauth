<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>搜狐(SOHU)OAuth认证PHP示例</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<style>
		p {
			font-size:14px;
			}
	</style>
  </head>
  <body>
    <div>
      <h4>搜狐(SOHU)OAuth认证PHP示例。</h4>
      <p>此示例将获取到的access token存储到session中去。如果有问题，请<a href='./clearsessions.php'>清空session</a>后重试。</p>      
      <?php if (isset($menu)) { ?>
        <?php echo $menu; ?>
      <?php } ?>
    </div>
    <?php if (isset($status_text)) { ?>
      <?php echo '<h3>'.$status_text.'</h3>'; ?>
    <?php } ?>
    <p><?php print_r($content); ?></p>
  </body>
</html>
