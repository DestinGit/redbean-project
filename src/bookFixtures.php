<?php
require 'redbean-bootstrap.php';

use RedBeanPHP\R;

R::wipe('book');

$book = R::dispense('book');

$book->title = 'les chants de Maldoror';
$book->author = 'Lautréamont';

R::store($book);

$book = R::dispense('book');

$book->title = 'Les Regrets';
$book->author = 'Joaquim Du Bellay';
$book->genre = 'Poésie';
R::store($book);
