<?php
/**
 * 作者：车久龙
 * 时间：2009年7月29日11:06:33
 * 功能：UTF-8字符串截取
 * 版本：V.10
 * @param unknown_type $params 参数数组
 * @return unknown 截取后的字符串
 */
function smarty_function_utf8cut($params) {
    @$string = $params ['string'];
    @$leng = $params ['leng'];
    @$isdot = isset($params ['isdot'])?$params ['isdot']:true;
    @$dot = isset($params ['dot'])?$params ['dot']:"...";
    if (! isset ( $string ) || $string == '') {
        return '';
    }
    preg_match_all ( "/.{1}/", $string, $chars );
    $c = '';
    $all = array ();
    $timer = 0;
    foreach ( $chars [0] as $char ) {
        $timer ++;
        if (ord ( $char ) > 127) {
            $c .= $char;
            if ($timer == 3) {
                $all [] = $c;
                $c = '';
                $timer = 0;
            }
        } else {
            $c = $char;
            $timer = 0;
            $all [] = $c;
            $c = '';
        }
    }
    if (sizeof ( $all ) <= $leng) {
        return implode ( '', $all );
    }
    if($isdot){
        return implode ( '', array_slice ( $all, 0, $leng ) ) . $dot;
    }else{
        return implode ( '', array_slice ( $all, 0, $leng ) );
    }
    
}
?>
