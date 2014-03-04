<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Ralph
 * Date: 10/12/13
 * Time: 3:21 PM
 * To change this template use File | Settings | File Templates.
 */

function validate_between($check, $min, $max)
{
    $n = mb_strlen($check);
    return $min <= $n && $n <= $max;
}

function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_format($string)
{
    return ctype_alnum($string);
}