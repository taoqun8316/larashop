<?php


function test_helper() {
    return 'OK';
}

function tprint($value)
{
    print_r($value);
    die;
}

function password($password)
{
    return md5($password);
}