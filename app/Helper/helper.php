<?php

function flattenJson($data, $prefix = '') {
    $result = [];

    foreach ($data as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, flattenJson($value, $prefix . $key . '.'));
        } else {
            $result[$prefix . $key] = $value;
        }
    }

    return $result;
}
