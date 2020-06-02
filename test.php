<?php
$a = 'Елка';
if (!preg_match('/^[А-ЯЁ][а-яё]{1,24}$/', $a))
    echo 'Incorrect value';
else
    echo 'correct';
