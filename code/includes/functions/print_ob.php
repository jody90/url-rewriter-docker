<?php

function print_ob($data) {
    echo '<pre style="padding: 10px; position: relative; bottom: 0; border: 1px solid red; background: #ffe6b5">';
    print_r($data);
    echo '</pre>';
}