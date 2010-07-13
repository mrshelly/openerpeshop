<?php
    /*By shelly<mrshelly@hotmail.com> 2008-10 */
    if (! defined("IN_SYS")) define('IN_SYS', true);

    $outType=isset($_GET['o'])?trim($_GET['o']):'';
    $mod=isset($_GET['mod'])?trim($_GET['mod']):'default';

    $rootPath=".";
    $curDir = '';
    require_once "{$rootPath}/cfg/config.php";
    require_once "{$rootPath}/init.php";

    Switch($mod){
        case "api":
            $apiMod=isset($_GET['api'])?trim($_Get['api']):'';
            if(!in_array("{$curDir}/api/{$apiMod}",$siteCfg['apiset'])){
                exit($retOut(array('ret'=>'err','msg'=>'api part undefined!')));
            }
            if(!file_exists("{$rootPath}{$curDir}/api/{$apiMod}.php")){
                exit($retOut(array('ret'=>'err','mag'=>'api part error!')));
            }
            require "{$rootPath}{$curDir}/api/{$apiMod}.php";
            break;
        case "act":
            $actMod=isset($_GET['act'])?trim($_GET['act']):'';
            if(!in_array("{$curDir}/act/{$actMod}",$siteCfg['actset'])){
                exit($retOut(array('ret'=>'err','msg'=>'act part undefined')));
            }
            if(!file_exists("{$rootPath}{$curDir}/act/{$actMod}.php")){
                exit($retOut(array('ret'=>'err','msg'=>'act part error!')));
            }
            require "{$rootPath}{$curDir}/act/{$actMod}.php";
            break;
        case "sys":
            $sysMod=isset($_GET['sys'])?trim($_GET['sys']):'default';
            if(!file_exists("{$rootPath}{$curDir}/{$sysMod}.php")){
                exit($retOut(array('ret'=>'err','msg'=>'sys part error!')));
            }
            require "{$rootPath}{$curDir}/{$sysMod}.php";
            break;
        default:
            require "{$rootPath}{$curDir}/default.php";
            break;
    }
    exit;
?>