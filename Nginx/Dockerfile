# 拉取 CentOS
FROM centos:6.8

# 维护者
MAINTAINER Apple <apple@ipple.net>

# 设置 openssl 和 nginx 版本
ENV NGINX_VERSION 1.10.3
ENV OPENSSL_VERSION 1.0.2h

# 安装依赖
RUN set -x \
  && yum update -y \
  && yum install -y wget gcc gcc-c++ make automake autoconf libtool perl file tar bzip2-devel bzip2 openssl openssl-devel zlib zlib-devel pcre-devel \
  && groupadd www \
  && useradd -s /sbin/nologin -g www www \

  # 创建下载目录
  && mkdir ~/download \

  # 下载 openssl
  && cd ~/download \
  && wget https://www.openssl.org/source/openssl-$OPENSSL_VERSION.tar.gz \
  && tar -zxvf openssl-$OPENSSL_VERSION.tar.gz \

  # 下载 nginx
  && wget http://nginx.org/download/nginx-$NGINX_VERSION.tar.gz \
  && tar -zxvf nginx-$NGINX_VERSION.tar.gz \
  && cd nginx-$NGINX_VERSION \
  && ./configure \
    --prefix=/usr/local/nginx \
    --user=www \
    --group=www \
    --with-ipv6 \
    --with-http_stub_status_module \
    --with-http_gzip_static_module \
    --with-stream \
    --with-http_ssl_module \
    --with-http_v2_module \
    --with-http_realip_module \
    --with-http_sub_module \
    --with-openssl=/root/download/openssl-$OPENSSL_VERSION \
  && make \
  && make install \
  && mkdir /usr/local/nginx/conf/vhost \
  && mkdir /app \
  && chown -R www:www /app \
  && rm -rf ~/download

CMD ["/usr/local/nginx/sbin/nginx","-g","daemon off;"]

EXPOSE 80 443
