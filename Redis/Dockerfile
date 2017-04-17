# 拉取 CentOS
FROM centos:6.8

# 维护者
MAINTAINER Apple <apple@ipple.net>

# 设置 Redis 版本
ENV REDIS_VERSION 3.2.8

# 下载并编译
RUN set -x \
    && yum update -y \
    && yum install -y wget gcc gcc-c++ make perl tar \
    && cd /opt \
    && wget http://download.redis.io/releases/redis-$REDIS_VERSION.tar.gz \
    && tar -zxvf redis-$REDIS_VERSION.tar.gz \
    && cd redis-$REDIS_VERSION/src \
    && make \
    && mkdir -p /usr/local/redis/bin \
    && cp redis-server redis-cli redis-benchmark /usr/local/redis/bin/ \
    && mkdir -p /usr/local/redis/conf \
    && cp /opt/redis-$REDIS_VERSION/redis.conf /usr/local/redis/conf/redis.conf \
    && rm -rf /opt/redis-$REDIS_VERSION.tar.gz \
    && rm -rf /opt/redis-$REDIS_VERSION

CMD ["/usr/local/redis/bin/redis-server","/usr/local/redis/conf/redis.conf"]

EXPOSE 6379
