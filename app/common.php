<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

//返回一个json
function rejson($code='',$msg='',$url=''){
	$data=array('code'=>$code,'msg'=>$msg);
	if($url!=''){
		$data['url']=$url;
	}
	echo json_encode($data);
	exit;
}

//获取坐标
function getDistance($lat1, $lng1, $lat2, $lng2){

    // 将角度转为弧度
    // deg2rad()函数将角度转换为弧度
    $radLat1 = deg2rad($lat1);
    $radLat2 = deg2rad($lat2);
    $radLng1 = deg2rad($lng1);
    $radLng2 = deg2rad($lng2);

    $a = $radLat1 - $radLat2;
    $b = $radLng1 - $radLng2;

    $s = 2 * asin(sqrt(pow(sin($a / 2), 2)+cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137;
    return ceil($s*1000);
}

//数组转xml

function array_xml($data){
    if(!is_array($data) || count($data) <= 0){
        return false;
    }
    $xml = '<xml>';
    foreach ($data as $key=>$val){
        if (is_numeric($val)){
            $xml.='<'.$key.'>'.$val.'</'.$key.'>';
        }else{
            $xml.='<'.$key.'><![CDATA['.$val.']]></'.$key.'>';
        }
    }
    $xml.="</xml>";
    return $xml; 
}

//生成随机字符串
function nonce_str(){
    $result = '';
    $str    = 'QWERTYUIOPASDFGHJKLZXVBNMqwertyuioplkjhgfdsamnbvcxz1234567890';
    for ($i=0;$i<6;$i++){
        $result .= $str[rand(0,58)];
    }
    return md5($result);
}

//curl请求
function http_request($url,$data = null,$headers=array()){   
    $curl = curl_init();
    if( count($headers) >= 1 ){
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);


    if (!empty($data)){
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($curl);
    curl_close($curl);
    return $output;
}

//数组转xml
function xml($xml){
    $p = xml_parser_create();
    xml_parse_into_struct($p, $xml, $vals, $index);
    xml_parser_free($p);
    $data = "";
    foreach ($index as $key=>$value) {
        if($key == 'xml' || $key == 'XML') continue;
        $tag = $vals[$value[0]]['tag'];
        $value = $vals[$value[0]]['value'];
        $data[$tag] = $value;
    }
    return $data;
}

//签名方法
function sign($data){
    $stringA = '';
    foreach ($data as $key=>$value){
        if(!$value) continue;
        if($stringA) $stringA .= '&'.$key."=".$value;
        else $stringA = $key."=".$value;
    }
    //申请支付后有给予一个商户账号和密码，登陆后自己设置key
    $wx_key = 'Zh8wW8JanGwAn9gJiE9THfZ4FPlOtFGd';
    //申请支付后有给予一个商户账号和密码，登陆后自己设置key 
    $stringSignTemp = $stringA.'&key='.$wx_key;
    return strtoupper(md5($stringSignTemp));
}

//去除部分html
function strip($str)
{
    $str=str_replace("<br>","",$str);
    $str=htmlspecialchars($str);
    return strip_tags($str);
}

//需要使用证书的请求
function postXmlSSLCurl($xml,$url,$certpath,$keypath,$second=30)
{
    $ch = curl_init();
    //超时时间
    curl_setopt($ch,CURLOPT_TIMEOUT,$second);
    //这里设置代理，如果有的话
    //curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
    //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
    //设置header
    curl_setopt($ch,CURLOPT_HEADER,FALSE);
    //要求结果为字符串且输出到屏幕上
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
    //设置证书
    //使用证书：cert 与 key 分别属于两个.pem文件
    //默认格式为PEM，可以注释
    curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
    curl_setopt($ch,CURLOPT_SSLCERT, $certpath);
    //默认格式为PEM，可以注释
    curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
    curl_setopt($ch,CURLOPT_SSLKEY, $keypath);
    //post提交方式
    curl_setopt($ch,CURLOPT_POST, true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$xml);
    $data = curl_exec($ch);
    //返回结果
    if($data){
        curl_close($ch);
        return $data;
    }else{
        $error = curl_errno($ch);
        echo "curl出错，错误码:$error"."<br>";
        curl_close($ch);
        return false;
    }
}

//输入安全函数
function processed($data)
{
    //目前该函数只接受一维数组
	// if(empty($data) || is_bool($data) || is_null($data))
		// return 'Don’t match';

    if(is_array($data) && !empty($data))
    {
        foreach ($data as $dak => $dav) {
            if(is_array($dav))
                return false;
            else
                $data[$dak] = trim(strip_tags(addslashes($dav)));
        }
    }
    else
        return false;
        // $data = trim(strip_tags(addslashes($data)));

    return $data;
}

//传递数据以易于阅读的样式格式化后输出
function pres($data)
{
    // 定义样式
    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';

    // 如果是boolean或者null直接显示文字；否则print
    if (is_bool($data))
        $show_data=$data ? 'true' : 'false';
    elseif (is_null($data))
        $show_data='null';
    else
        $show_data=print_r($data,true);

    $str.=$show_data;
    $str.='</pre>';
    echo $str;
}

//检测是否设置
function checkSet($data,...$datas)
{   
    if(empty($datas))
    {
        return false;
    }

    foreach ($datas as $dtk => $dav)
    {
        if(!isset($data[$dav]))
        {
            return false;
        }
    }

    return true;
}