<?php
require_once __DIR__.'/router.php';

get('/', 'view/main.php');

get('/edit','view/createProject.php');

post('/edit', 'view/editProject.php');

get('/delete', 'view/deleteProject.php');

any('/404','view/404.php');
?>
