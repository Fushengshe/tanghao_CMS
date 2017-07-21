# 自推荐－后端API文档


## 正片开始

## Token的单独验证接口
> http://123.206.18.103/Market_BE/public/index.php/admin/auth/validateToken?token=8fafecf4a5448d83944a57b3a9636caaae94f71c

数据传输方式：GET

数据传输格式为：JSON


参数(类型) | 说明 | 示例
----|------|----
token(string) | 传入token  | 8fafecf4a5448d83944a57b3a9636caaae94f71c

验证成功返回

`{"code":0,"msg":"token正常","token":"8fafecf4a5448d83944a57b3a9636caaae94f71c"}`

验证失败返回

`{"code":1,"msg":"token错误，请重新登录","token":"8fafecf4a5448d83944a57b3a9636caaae94f71"}`
`{"code":2,"msg":"token过期，请重新登录","token":"8fafecf4a5448d83944a57b3a9636caaae94f71"}`




## 用户注册登录
### 用户的登录
> http://123.206.18.103/Market_BE/public/index.php/admin/auth/login

数据传输方式为：POST

数据传输格式为：JSON:

参数(类型) | 说明 | 示例
----|------|----
mobile(string) | 传入手机号  | 15933445710
password(string) | 传入密码  | 123456

登录成功将返回

`
{
    "code": 0,
    "data": {
        "user": {
            "userId": 31,
            "mobile": "15933445710"
        }
    },
    "token": "289e139fdc36a936105a4211fb726dbb39188a3d"
}
`

如果登录失败将返回

`{"code":1,"msg":"密码错误"}`
`{"code":1,"msg":"用户不存在"}`


### 用户注册
> http://123.206.18.103/Market_BE/public/index.php/admin/auth/register
数据传输方式：POST

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
username(string) | 传入用户名  | zhangqirong
password(string) | 传入密码  | 123456
confirm(string) | 传入重复密码  | 123456
mobile(string) | 传入手机  | 15603302558

手机号必须唯一，用户名必须唯一，密码与确认密码必须一致

注册成功将返回：

`{"code":0,"msg":"注册成功"}`

注册数据错误将返回例如

`{"code":1,"msg":"用户名已经存在"}`
`{"code":1,"msg":"手机已经注册"}`


## 忘记密码
###一、发送验证码(123456)
> http://123.206.18.103/Market_BE/public/index.php/admin/forget/sendcode
数据传输方式：POST

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
mobile(string) | 传入手机号  | 15603302558

手机号必须唯一

注册成功将返回：

`{"code":1,"msg":"已发送验证码，请注意查收"}`


注册数据错误将返回例如
`{"code":1,"msg":"手机号不存在"}`

###二、重置密码
> http://123.206.18.103/Market_BE/public/index.php/admin/forget/resetPassword
数据传输方式：POST

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
mobile(string) | 传入手机号  | 13223346690
password(string) | 传入新密码  | 12345678
confirm(string) | 传入确认新密码  | 12345678
verify(string) | 传入验证码  | 123456

手机号必须唯一，验证码唯一，验证码未过期，密码与确认密码必须一致

注册成功将返回：

`{"code":1,"msg":"已重置密码，请重新登录"}`


注册数据错误将返回例如
`{"code":1,"msg":"验证码错误"}`
`{"code":1,"msg":"验证码已失效"}`



## 商品的增删改查

### 添加商品
> http://123.206.18.103/Market_BE/public/index.php/admin/goods/add

数据传输方式：POST

数据传输格式为：JSON


参数(类型) | 说明 | 示例
----|------|----
goods_id(int) | 传入goods_id，可不填  | 1
shop_id(int) | 传入shop_id，必填  | 1
cat_id(string) | 传入cat_id，必填  | 1
goods_name(string) | 传入goods_name，必填   | 衬衫
goods_price(int) | 传入goods_price，必填   | 84
goods_click(int) | 传入goods_click  | 10
goods_desc(string) | 传入goods_desc  | 这是衬衫
goods_img\[\](file) | 传入goods_img[],可上传多个图片  | /public/static/img/1.jpg
is_on_sale(bool) | 传入is_on_sale  | 1
sales_volume(string) | 传入sales_volume  | 100
goods_location(string) | 传入goods_location  | goods_location
goods_weight(string) | 传入goods_weight  | 50g
goods_size(string) | 传入goods_size  | 100cm*100cm
goods_distance(string) | 传入goods_distance  | 2km

验证成功返回

`{"code":0,"msg":"添加数据成功"}`

验证失败返回

`{"code":1,"msg":"失败提示信息"}`
`{"code":2,"msg":"该商品id已存在！"}`



### 删除商品
> http://123.206.18.103/Market_BE/public/index.php/admin/goods/del

数据传输方式为：POST

数据传输格式为：JSON:

参数(类型) | 说明 | 示例
----|------|----
goods_id(int) | 传入商品id  | 2

删除成功将返回

`
{
    "code": 0,
    "msg":"删除成功"
}
`

如果删除失败将返回

`{"code":1,"msg":"删除失败，请稍后再试"}`


### 修改商品
> http://123.206.18.103/Market_BE/public/index.php/admin/goods/edit
数据传输方式：POST

数据传输格式为：JSON

参数(类型) | 说明 | 示例
----|------|----
goods_id(int) | 传入goods_id，可不填  | 1
shop_id(int) | 传入shop_id，必填  | 
cat_id(string) | 传入cat_id，必填  | 1
goods_name(string) | 传入goods_name，必填   | 衬衫
goods_price(int) | 传入goods_price，必填   | 84
goods_click(int) | 传入goods_click  | 10
goods_desc(string) | 传入goods_desc  | 这是衬衫
goods_img(string) | 传入goods_img  | /public/static/img/1.jpg
is_on_sale(bool) | 传入is_on_sale  | 1
sales_volume(string) | 传入sales_volume  | 100
goods_location(string) | 传入goods_location  | goods_location
goods_weight(string) | 传入goods_weight  | 50g
goods_size(string) | 传入goods_size  | 100cm*100cm
goods_distance(string) | 传入goods_distance  | 2km


修改成功将返回：

`{"code":0,"msg":"修改数据成功"}`

注册数据错误将返回例如

`{"code":1,"msg":"修改数据失败的提示信息"}`
`{"code":2,"msg":"请输入要修改商品的id"}`



### 查询商品
>http://123.206.18.103/Market_BE/public/index.php/admin/goods/show

数据传输方式为：POST

数据传输格式为：JSON:

参数(类型) | 说明 | 示例
----|------|----
goods_id(int) | 传入商品id  | 2

查询成功将返回

`
{"code":0,"goods_id":2,"shop_id":2,"cat_id":2,"goods_name":"\u957f\u88e4","goods_price":50,"goods_click":9,"goods_desc":"????","goods_img":"public\/image2","is_on_sale":1,"sales_volume":200,"goods_location":"mki","goods_weight":"200g","goods_size":"L,XL,XXL","comment_num":6,"good_comment_num":3,"bad_comment_num":2,"middle_comment_num":1,"goods_distance":"200m"}
`

如果查询失败将返回

`{"code":1,"msg":"查询数据失败,请检查商品id是否存在，且稍后再试"}
"code":2,"msg":"请输入商品id"}
`


