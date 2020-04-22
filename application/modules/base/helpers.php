<?php

// template-safe print
function p(string $arg)
{
    echo htmlspecialchars($arg);
}

function linkTo(string $url)
{
    return ROOT . $url;
}

function include_with_vars(string $template, $variables)
{
    extract($variables);
    include $template;
}

function dateTxt($date)
{
    $time = strtotime($date);
    // if not valid date return original value
    if ($time === false) {
        return $date;
    } else {
        return date("d.m.Y", $time);
    }
}

function boolTxt($val)
{
    return $val ? "Ano" : "Ne";
}

function addParamsToCurrentLink($params)
{
    $get = $_GET;
    unset($get["url"]);
    $params = array_merge($get, $params);
    return "?" . http_build_query($params);
}


function printVIN($vin)
{
    p(substr($vin, 0, 15 - 7));
    echo "<strong>";
    p(substr($vin, 15 - 7));
    echo "</strong>";
}
