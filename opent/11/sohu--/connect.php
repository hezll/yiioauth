<?php

/**
 * @file
 * Check if consumer token is set and if so send user to get a request token.
 */

/**
 * Exit with an error message if the CONSUMER_KEY or CONSUMER_SECRET is not defined.
 */
require_once('config.php');
if (CONSUMER_KEY === '' || CONSUMER_SECRET === '') {
  echo '请先设置Consumer Key以及对于的Consumer Key Secret。如果还没有的话，可以到<a href="http://open.t.sohu.com/index.jsp">http://open.t.sohu.com/index.jsp</a>申请。';
  exit;
}

/* 开始申请access token */
$content = '<a href="./redirect.php">申请Access Token</a>';
 
/* Include HTML to display on the page. */
include('html.inc');
?>