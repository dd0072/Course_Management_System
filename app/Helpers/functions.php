<?php


/**
 * 弹出信息提示框
 * @param [type] $msg   要在网页上显示的提示信息
 * @param string $type  success / danger
 * @return void
 */
function alert($msg, $type = 'success')
{
    session()->flash($type, $msg);
}

/**
 * 获取指定key的数据库配置信息
 * @param [type] $key
 * @return void
 */
 function setting($key)
{
    $data = app('App\Models\Setting')->kv();
    return $data[$key];
}