<?php

function convertToNumeric($num)
{
    return str_replace(['.', ','], '', $num);
}
