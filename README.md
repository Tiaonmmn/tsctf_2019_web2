# 北邮天枢2019 TSCTF线下邀请赛 Web2

## 题目详情

- **TSCTF 线下 Web2**

## 考点

- 一大堆
- 比赛当时就审出来一个SQL注入
- 以及不知是否是主办方失误了，在inc/conn.php的SQL查询函数query()那里添加mysqli_error()，但是忘记添加参数了，我在源码里补上了
- etc.

## 环境重点
- PHP+MySQL ZZCMS2019
- 本来想用Alpine Linux的，后来为保持原比赛时环境，采用的phusion/baseimage
- 真正比赛时用的是虚拟机
- PHP版本必须为7.0
- 供选手登录的账户信息写在Dockerfile的ENV username和ENV password下，root用户密码为ENV rootpassword，MySQL的root密码为ENV mysqlrootpassword
- 开放root用户登录ssh
- data.sql在/var/www/html/下

## 启动

    docker-compose up -d
    Web Server is 80 port at http://127.0.0.1:3599/
    Openssh Server is 22 port at tsctf@127.0.0.1:3600

## 版权

该题目复现环境尚未取得主办方及出题人相关授权，如果侵权，请联系本人删除（tiaonmmn@live.cn）
