# 拉取 CentOS
FROM centos:6.9

# 维护者
MAINTAINER Apple <apple@ipple.net>

# 设置 PHP 版本
ENV PHP_VERSION 7.2.0

# 安装依赖
RUN set -x \
    && yum update -y \
    && yum install epel-release -y \
    && yum install -y wget git gcc gcc-c++ make automake autoconf perl file tar re2c libjpeg libpng libjpeg-devel libpng-devel libjpeg-turbo freetype freetype-devel \
                libcurl-devel libxml2-devel libjpeg-turbo-devel libXpm-devel libXpm libicu-devel libmcrypt libmcrypt-devel libxslt-devel libxslt openssl openssl-devel bzip2-devel \
    && groupadd www \
    && useradd -s /sbin/nologin -g www www \

    # 建立目录
    && mkdir -p /usr/local/php \
    && mkdir ~/download \
    && cd ~/download \

    # 编译 PHP
    && wget http://cn2.php.net/distributions/php-$PHP_VERSION.tar.gz \
    && tar -zxf php-$PHP_VERSION.tar.gz \
    && cd php-$PHP_VERSION \
    && ./configure \
             --prefix=/usr/local/php \
             --with-config-file-path=/usr/local/php/etc/ \
             --with-config-file-scan-dir=/usr/local/php/conf.d/ \
             --enable-fpm \
             --enable-cgi \
             --disable-phpdbg \
             --enable-mbstring \
             --enable-calendar \
             --with-xsl \
             --with-openssl \
             --enable-soap \
             --enable-zip \
             --enable-shmop \
             --enable-sockets \
             --with-gd \
             --enable-gd-native-ttf \
             --with-freetype-dir=/usr/include/freetype2/freetype \
             --with-jpeg-dir \
             --with-png-dir \
             --with-xpm-dir \
             --with-xmlrpc \
             --enable-pcntl \
             --enable-intl \
             --with-mcrypt \
             --enable-sysvsem \
             --enable-sysvshm \
             --enable-sysvmsg \
             --enable-opcache \
             --with-iconv \
             --with-bz2 \
             --with-curl \
             --enable-mysqlnd \
             --with-mysqli=mysqlnd \
             --with-pdo-mysql=mysqlnd \
             --with-zlib \
             --with-gettext \
             --enable-mbregex \
             --enable-inline-optimization \
             --enable-session \
             --enable-bcmath \
             --enable-ftp \
    && make \
    && make install \

    # 复制配置文件
    && cp ~/download/php-$PHP_VERSION/php.ini-production /usr/local/php/etc/php.ini \
    && cp /usr/local/php/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf \
    && cp /usr/local/php/etc/php-fpm.d/www.conf.default /usr/local/php/etc/php-fpm.d/www.conf \

    # 安装 Redis 扩展
    && cd ~/download \
    && git clone -b php7-ipv6 https://github.com/phpredis/phpredis.git \
    && cd phpredis \
    && /usr/local/php/bin/phpize \
    && ./configure --with-php-config=/usr/local/php/bin/php-config \
    && make \
    && make install \

    # 加入环境变量
    && echo "export PATH=/usr/local/php/bin:/usr/local/php/sbin:$PATH" >> ~/.bashrc \
    && source ~/.bashrc \

    # 安装 Composer
    && cd ~/download \
    && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/sbin --filename=composer \
    && php -r "unlink('composer-setup.php');" \
    && composer config -g repo.packagist composer https://packagist.phpcomposer.com \


    # 删除安装文件
    && rm -rf ~/download


CMD ["/usr/local/php/sbin/php-fpm"]

EXPOSE 9000
