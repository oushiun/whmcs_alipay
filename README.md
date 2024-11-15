# whmcs_alipay
whmcs 后台支付宝支付网关，支持 v8.10.1


## 使用教程
1. 根目录`alipay.php`上传至`ROOT_PATH/modules/geteways`
2. 将`alipay`和`callback`文件夹上传到`ROOT_PATH/modules/geteways`
3. 前往[支付宝开放平台](https://open.alipay.com/)注册应用
4. 下载[RSA2密钥生成器](https://opendocs.alipay.com/common/02kipk),或者使用[OpenSSL工具生成密钥](https://opendocs.alipay.com/common/02khjt)
5. 在支付宝开放平台开发设置中填写获得的公钥，注意前后空格和换行
6. 前往whmcs支付网关alipay中填写APPID、公钥、密钥
