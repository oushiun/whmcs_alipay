<?php
if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use Illuminate\Database\Capsule\Manager as Capsule;

class alipay_config{   
    function get_configuration (){     
        global $_ADMINLANG, $CONFIG;
        $type = Capsule::table("tblpaymentgateways")->where("gateway","alipay")->where("setting","type")->first();
        if ($type->value != "即时到账" and $type->value != "当面付"){
            $extra_config = [
                "notice" => [
					'FriendlyName' => '温馨提示',
					'Type' => 'dropdown',
					'Options' => [
						'warn' => "</option></select><div class='alert alert-danger' role='alert' id='alipay_notice' style='margin-bottom: 0px;'>请点击 [ ".$_ADMINLANG['global']['savechanges']." ] 后 , 再进行修改配置</div><script>$('#alipay_notice').prev().hide();</script><select style='display:none'>"
                    ]
                ]
            ];
        } else {
			if ($type->value == "即时到账") {
				$extra_config = [
                    "app_id" => ["FriendlyName" => "应用ID (APPID)", "Type" => "text", "Size" => "60"],
					"alipay_key" => ["FriendlyName" => "支付宝公钥", "Type" => "textarea",  'Rows' => '7', 'Cols' => '60'],
                    "rsa_key" => ["FriendlyName" => "RSA2(SHA256) 私钥", "Type" => "textarea",  'Rows' => '10', 'Cols' => '60',"Description" => ""]
                ];
			}
			if ($type->value == "当面付") {
				$extra_config = [
					"app_id" => ["FriendlyName" => "应用ID (APPID)", "Type" => "text", "Size" => "60"],
					"alipay_key" => ["FriendlyName" => "支付宝公钥", "Type" => "textarea",  'Rows' => '7', 'Cols' => '60'],
					"rsa_key" => ["FriendlyName" => "RSA2(SHA256) 私钥", "Type" => "textarea",  'Rows' => '10', 'Cols' => '60',"Description" => "密钥生成提示 :<br><a type='button' class='btn btn-primary' href='https://opendocs.alipay.com/common/02kipk' target='_blank'><span class='glyphicon glyphicon-new-window'></span> RSA2(SHA256) 生成器下载</a>&nbsp;&nbsp;&nbsp;&nbsp;<a type='button' class='btn btn-primary' href='https://opendocs.alipay.com/common/02khjt' target='_blank'> <span class='glyphicon glyphicon-new-window'></span> OpenSSL生成教程</a><br>1. 请在上方正确填写公钥和私钥（注意不要前后空格和换行） 2. 请在<a href='https://open.alipay.com/develop/pm/sub/setting' target='_blank'><span class='glyphicon glyphicon-new-window'></span>商家支付宝 开放平台</a>填写公钥（注意不要前后空格和换行）" ],
					"notice" => [
						'FriendlyName' => '',
						'Type' => 'dropdown',
						'Options' => [
							'QrPay' => ""   //
						]
					]
				];
			}
        }
        $base_config = [
            "FriendlyName" => ['Type' => 'System','Value' => '支付宝'],
            "type" => ['FriendlyName' => '支付宝接口类型','Type' => 'dropdown',
                'Options' => [
					"当面付" => "[官方] 当面付",
                    "即时到账" => "[官方] 即时到账"
                ]
            ]
        ];
        
        $config = array_merge($base_config,$extra_config);
        $config["author"] = [
            'FriendlyName' => '',
            'Type' => 'dropdown',
            'Options' => [
                '52Fancy' => "</option></select><div class='alert alert-success' role='alert' id='alipay_author' style='margin-bottom: 0px;'>该插件由52fancy开发，oushiun优化 ，本插件为免费开源插件<br/><span class='glyphicon glyphicon-ok'></span> 支持 WHMCS 5/6/7/8 , 当前WHMCS 版本 ".$CONFIG["Version"]."<br/><span class='glyphicon glyphicon-ok'></span> 仅支持 PHP 5.4 以上的环境 , 当前PHP版本 ".phpversion()."</div><script>$('#alipay_author').prev().hide();</script><style>* {font-family: Microsoft YaHei Light , Microsoft YaHei}</style><select style='display:none'>"
            ]
        ];
        return $config;
    }
}
