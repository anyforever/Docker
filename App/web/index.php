<?php
// redis test
$redis = new Redis();
$redis->connect('redis', 6379);
$redis->auth('123456');
$i = $redis->info();
$redis->close();

echo "Connection to redis server sucessfully";
echo '<pre>';
print_r($i);
