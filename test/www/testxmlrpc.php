<?php
    require_once("./lib/xmlrpc.inc");

    $active_ids = array(
        new xmlrpcval('109', 'int'),
    );

    $context = array(
    'lang'=>new xmlrpcval('en_US', "string") ,
    'tz'=>new xmlrpcval('0', "boolean") ,
    'active_ids'=>new xmlrpcval($active_ids, "array") ,
    'active_id'=>new xmlrpcval('109', "int") ,
    );

    $client = new xmlrpc_client("http://localhost:8069/xmlrpc/object");
    $client->return_type = 'phpvals';

    // 取product.product fields_view_get
        $msg = new xmlrpcmsg('execute');
        $msg->addParam(new xmlrpcval("attend", "string"));
        $msg->addParam(new xmlrpcval("1", "int"));
        $msg->addParam(new xmlrpcval("admin", "string"));
        $msg->addParam(new xmlrpcval("product.product", "string"));
        $msg->addParam(new xmlrpcval("fields_view_get", "string"));
        $msg->addParam(new xmlrpcval("128", "int"));
        $msg->addParam(new xmlrpcval("tree", "string"));
        $msg->addParam(new xmlrpcval($context, "struct"));
        $msg->addParam(new xmlrpcval("1", "boolean"));

        $resp = $client->send($msg);

        print_r($resp->value());


    // 检索product.product
        $filter = array();

        $msg = new xmlrpcmsg('execute');
        $msg->addParam(new xmlrpcval("attend", "string"));
        $msg->addParam(new xmlrpcval("1", "int"));
        $msg->addParam(new xmlrpcval("admin", "string"));
        $msg->addParam(new xmlrpcval("product.product", "string"));
        $msg->addParam(new xmlrpcval("search", "string"));
        $msg->addParam(new xmlrpcval($filter, "array"));
        $msg->addParam(new xmlrpcval("0.0", "double"));
        $msg->addParam(new xmlrpcval("80.0", "double"));
        $msg->addParam(new xmlrpcval("0", "int"));
        $msg->addParam(new xmlrpcval($context, "struct"));

        $resp = $client->send($msg);

        print_r($resp->value());

    exit;

?>