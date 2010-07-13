<?php
	/* By shelly<mrshelly@hotmail.com> 2008-10 */

	/* 动作处理不允许直接调用 */
		if (! defined("IN_SYS")) exit("Access Denied");

	// 分页设置

		$pp=isset($_GET['pp'])?intval($_GET['pp']):30;
		$p = isset($_GET['p'])?intval($_GET['p']):1;
		$start=($p-1)*$pp;

		exit;
?>