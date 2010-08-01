<?php
    require_once("./lib/xmlrpc.inc");
    $client = new xmlrpc_client("http://localhost:8069/xmlrpc/object");
    $client->return_type = 'phpvals';

	$uid = 1;
	$pass='adminpass';

	// 假设服务器端各类别版本号
	$category_version = array(
		'1'=>1,
		'2'=>3,
		'3'=>1,
	);
	// 获取某类别下的商品ID
	function getProductListByCate($cateid, $p, $pp, $order){
		global $category_version, $client, $uid, $pass;
		$cacheData = array();
		if(!file_exists('./cache/')){
			mkdir('./cache/');
			chmod('./cache/', 0777);
		}
		if(!file_exists("./cache/cate_{$cateid}/")){
			mkdir("./cache/cate_{$cateid}/");
			chmod("./cache/cate_{$cateid}/", 0777);
		}
		if(file_exists("./cache/cate_{$cateid}/{$p}_{$pp}_{$order}.cache")){
			$cacheData = json_decode(@file_get_contents("./cache/cate_{$cateid}/{$p}_{$pp}_{$order}.cache"), true);
		}

		if(!isset($cacheData['ver']) || $cacheData['ver']<$category_version["{$cateid}"]){
			// 本地未缓存. 或者缓存数据与服务器版本不一致
			// 检索product.product
				//$filter = array(array('cate_id', 'child_of', $cateid));
				$filter = array(new xmlrpcval(array(new xmlrpcval('categ_id', 'string'), new xmlrpcval('child_of', 'string'), new xmlrpcval(array(new xmlrpcval($cateid, 'int')), 'array')), 'array'));

				$msg = new xmlrpcmsg('execute');
				$msg->addParam(new xmlrpcval("test", "string"));
				$msg->addParam(new xmlrpcval("{$uid}", "int"));
				$msg->addParam(new xmlrpcval("{$pass}", "string"));
				$msg->addParam(new xmlrpcval("product.product", "string"));
				$msg->addParam(new xmlrpcval("search", "string"));
				$msg->addParam(new xmlrpcval($filter, "array"));
				$msg->addParam(new xmlrpcval("{$p}", "double"));
				$msg->addParam(new xmlrpcval("{$pp}", "double"));
				$msg->addParam(new xmlrpcval("0", "int"));
				$msg->addParam(new xmlrpcval(array('lang'=>new xmlrpcval('en_US', "string"),'tz'=>new xmlrpcval('0', "boolean"), 'active_ids'=>new xmlrpcval(array(new xmlrpcval($cateid, 'int')), 'array'), 'categ_id'=>new xmlrpcval($cateid, 'int'), 'active_id'=>new xmlrpcval($cateid, 'int')), "struct"));
				$resp = $client->send($msg);
				$ret = $resp->value();

				$cacheData = array('ver'=>1, 'list'=>$ret);
				@file_put_contents("./cache/cate_{$cateid}/{$p}_{$pp}_{$order}.cache", json_encode($cacheData));
		}

		return $cacheData;
	}

	$test = getProductListByCate(1, 0, 80, 0);
	var_dump($test);
	$test = getProductListByCate(1, 0, 80, 0);
	var_dump($test);
	$test = getProductListByCate(1, 0, 80, 0);
	var_dump($test);
	$test = getProductListByCate(1, 0, 80, 0);
	var_dump($test);
    exit;

?>