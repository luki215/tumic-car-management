<?php

function linkTo(string $url)
{
    return ROOT . $url;
}

function include_with_vars(string $template, $variables)
{
    extract($variables);
    include $template;
}
