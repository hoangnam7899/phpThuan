<?php
$_config = ['app','database'];
foreach ($_config as $file ) {
   include __DIR__ . '/../config/' .$file . '.php';
}

$_route = ['api','web'];
foreach ($_route as $file ) {
   include __DIR__ . '/../routes/' .$file . '.php';
}