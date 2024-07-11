<?php

function url_plug()
{
    $data = url('/');
    return $data;
}
function url_img()
{
    $data = public_path('img');
    return $data;
}
function url_foto()
{
    $data = public_path('attach\pekerjaan');
    return $data;
}
