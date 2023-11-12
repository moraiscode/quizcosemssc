<?php

define('NAME', 'Alexandre');

$_SESSION['name'] = 'Alexandre';

$names = ['Alexandre', 'Joao'];

if (count($names) > 2) {
    var_dump('maior que 2');
}
