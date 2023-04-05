<?php

if (!function_exists('clear_string')) {
    function clear_string(string $label) {
        return implode(' ', explode('_', ucwords($label)));
    }
}
