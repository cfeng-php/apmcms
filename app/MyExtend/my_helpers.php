<?php

if(!function_exists('delFileInDir')){
    function delFileInDir($dir)
    {
        $dh=opendir($dir);
        while ($file=readdir($dh)) {
            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    delFileInDir($fullpath);
                }
            }
        }
        closedir($dh);
    }
}

if(!function_exists('getMetricServiceTypeName')){
    function getMetricServiceTypeName($type)
    {
        $arr = [
            '1' => '服务器',
            '2' => '关系型数据库',
            '3' => '内存数据库',
            '4' => 'NOSQL数据库',
            '5' => '消息队列',
            '6' => 'WINDOWS平台',
            '7' => '大数据',
            '8' => '集群部署与管理',
            '9' => '开发集成',
            '10' => '系统相关'
        ];

        return isset($arr[$type]) ? $arr[$type] : '';
    }
}

if(!function_exists('getMetricTypeName')){
    function getMetricTypeName()
    {
        return [
            "count",
            "rate",
            "gauge",
            "counter"
        ];
    }
}

if(!function_exists('getPluralUnit')){
    function getPluralUnit()
    {
        return [
            "memory" => ["page","split"],
            "network" => ["timeout","packet","datagram","connection","message","payload","segment","response","request"],
            "money" => ["doller","cent"],
            "cache" => ["hit","get","set","miss","eviction"],
            "db" => [   "query","row","assertion","ticket","refresh","merge","flush","index","key","offset",
                        "wait","column","commit","table","transaction","cursor","record","fetch","scan",
                        "lock","shard","document","object","command"
                    ],
            "system" => ["node","core","host","thread","fault","service","process","instance"],
            "general" => ["read","resource","occurrence","operation","event","item","email","unit","garbage collection",
                            "work","error","sample","write","buffer","task","time"
                        ],
            "bytes" => ["bit","byte","kibibyte","mebibyte","gibibyte","tebibyte","pebibyte","exbibyte"],
            "frequency" => ["hertz","kilohertz","megahertz","gigahertz"],
            "time" => ["nanosecond","microsecond","millisecond","second","minute","hour","day","week"],
            "percentage" => ["percent_nano","apdex","percent","percent*100","fraction"],
            "disk" => ["sector","block","inode","file"]
        ];
    }
}

if(!function_exists('getPerUnit')){
    function getPerUnit()
    {

    }
}