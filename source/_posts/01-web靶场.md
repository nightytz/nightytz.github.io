---
title: web靶场环境集合
comments: true
toc: true
cover: https://cdn.jsdelivr.net/gh/zhaoze-jpg/Xianqi@main/imgg/1.webp
categories: 生活
tags:
  - 想法
abbrlink: 1
date: 2022-3-24 21:00:00
---


###                       六根清净方为道，退步原来是向前。

apt [options][command][package]
	options:-h -y(显示安装过程) -q(不显示安装过程)
	command:操作
	package:包名
apy-get install默认下载路径：
 	1:下载后的软件默认安装位置 /var/cache/apt/archives
 	2:安装后软件默认位置 /usr/share
 	3:可执行文件位置 /usr/bin
 	4:配置文件位置 /etc
 	5:lib文件位置 /usr/lib
```bash
apt对比apt-get
	apt-get           		apt      			安装软件包
	apt-get remove   		apt remove			删除,更换所有包
	apt-get purge			apt purge			移动软件包及配置文件
	apt-get update			apt update			查看可更新的包
	apt-get upgrade			apt upgrade 		更新
	apt-get autoremove		apt autoremove		自动删除不需要的包
	apt-get dist-upgrade	apt dist-upgrade	在升级软件包时自动处理依赖关系
	apt-cache search		apt search			搜索应用程序
	apt-cache show			apt show			显示安装细节
							apt list			
```
### ubuntu搭建web靶场

下载apache2
```bash
	sudo apt update//先检查升级
	sudo apt install apache2 -y
	//sudo apt-get remove apache2 卸载
```
安装后默认启动服务
关闭服务：sudo systemctl stop apache2.service 或者 sudo /etc/init.d/apache2 stop

开启服务：sudo systemctl start apache2.service 或者 sudo /etc/init.d/apache2 start

更新服务：sudo systemctl reload apache2.service 或者 sudo /etc/init.d/apache2 reload

重启服务：sudo systemctl restart apache2.service 或者 sudo /etc/init.d/apache2 restart
###apache的文件和目录
默认网站根目录/var/www/html：实际的web内容由此提供，可以从配置文件更改

服务器配置/etc/apache2：apache配置目录，所有apache配置文件，
	/etc/apache2/apache2.conf的住配置文件，这里可以修该为对apache全局配置进行更改。该文件负责在配置目录中加载其他文件
	/etc/apache2/ports.conf该文件指定apache将监听的端口。默认情况下，当启用提供SSL功能模块时，apache会监听80，并在443进行监听
	/etc/apache2/sites-available/存储每个站点虚拟主机的目录。 Apache不会使用此目录中找到的配置文件，除非它们链接到sites-enabled了sites-enabled目录（见下文）。 通常，所有服务器块配置都在此目录中完成，然后通过使用a2ensite命令链接到另一个目录来启用。
	/etc/apache2/sites-enabled/ ：存储启用了每个站点“虚拟主机”的目录。 通常，这些是通过链接到具有a2ensite的sites-available目录中找到的配置文件创建的。 Apache在启动或重新加载以编译完整配置时读取此目录中找到的配置文件和链接
	/etc/apache2/conf-available/ ， /etc/apache2/conf-enabled/ ：这些目录与sites-available和sites-enabled目录具有相同的关系，但用于存储不属于虚拟主机 conf-available目录中的文件可以使用a2enconf命令启用，并使用a2enconf命令禁用
	/etc/apache2/mods-available/ ， /etc/apache2/mods-enabled/ ：这些目录分别包含可用和启用的模块。 以.load结尾的文件包含加载特定模块的片段，而以.conf结尾的文件包含这些模块的配置。 可以使用a2enmod和a2dismod命令启用和禁用模块。

服务器日志：
	/var/log/apache2/access.log ：默认情况下，对Web服务器的每个请求都记录在此日志文件中，除非Apache被配置为执行其他操作
	/var/log/apache2/error.log ：默认情况下，所有错误都记录在此文件中。 Apache配置中的LogLevel指令指定错误日志将包含多少细节



安装PHP
```bash
	sudo apt install php -y
	sudo apt install libapache2-mod-php -y
	重启apache
```
下载mysql
```bash
	sudo apt install mysql-server phpx.x（当前版本）-mysql -y
	sudo apt install mysql-client -y
```
配置数据库
```bash
	查看配置文件
	vim /etc/mysql/debian.cnf
	用户debian-sys-maint
	初始pass：*******
	更新密码
	use mysql;
	alter user 'root'@'localhost' identified with mysql_native_password by '123456'；（8.0以上）

```
安装phpmyadmin
```bash
	sudo apt-get install phpmyadmin
	sudo apt-get install php-mbstring
	sudo apt-get install php-gettext

	/var/www/html/phpmyadmin
	登录密码：
```

### 下载靶场环境

整理了一些靶场供学习使用
更换html下的index.html->模板自行下载
dwva下载地址： https://github.com/digininja/DVWA
数据库由程序自动创建，也可修改配置文件自行创建。
用户名有五个。

### 遇到一些令人头疼的问题
访问权限问题：	解决又没完全解决
apache配置文件：	解决方案1->没事别瞎动
				解决方案2->推倒重来

=====================