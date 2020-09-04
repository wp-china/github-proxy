<?php
/**
 * Wordpress Release Mirrors
 *
 * 从WordPress的官方GitHub仓库镜像其所有正式发行版
 *
 * @copyright  Copyright (c) 2020 - WP-China.org
 * @license    http://www.gnu.org/licenses/gpl-3.0.html  GPLv3 License
 */

// 之所以包含'WordPress@'是为了兼容之前反代jsDelivr时遗留的URL格式，e.g：/WordPress@5.5.1/wp-includes/js/codemirror/codemirror.min.js?ver=5.5
$tmp = explode('?', str_replace('WordPress@', '', $_GET['path']));
$request_path = $tmp[0];
$request_param = key_exists(1, $tmp) ? $tmp[1] : '';
$tmp = explode('.', $request_path);
$file_extend = explode('.', $request_path)[count($tmp) - 1];

$mime_types = [
    'css' => 'text/css',
    'js' => 'text/javascript'
];

header('Content-Type:' . $mime_types[$file_extend]);

$ch = curl_init();
$url=sprintf('https://raw.githubusercontent.com/WordPress/WordPress%s%s', $request_path, empty($request_param) ? '' : '?' . $request_param);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding:gzip'));
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
echo curl_exec($ch);
