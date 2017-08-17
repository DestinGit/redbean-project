<?php
require 'redbean-bootstrap.php';

use RedBeanPHP\R;

R::wipe('book');
R::trashAll(R::findAll('beer'));
R::trashAll(R::findAll('beerkind'));

$book = R::dispense('book');

$book->title = 'les chants de Maldoror';
$book->author = 'Lautréamont';

R::store($book);

$book = R::dispense('book');

$book->title = 'Les Regrets';
$book->author = 'Joaquim Du Bellay';
$book->genre = 'Poésie';
R::store($book);


$kinds = R::dispense('beerkind', 3);
$kinds[0]->kind = 'blonde';
$kinds[1]->kind = 'brune';
$kinds[2]->kind = 'noire';


$beers = R::dispense('beer', 5);

$beers[0]->name = 'Leffe';
$beers[0]->kind = $kinds[0];
$beers[0]->strengh = 6.5;
$kinds[0]->ownBeer[] = $beers[0];

$beers[1]->name = 'Guiness';
$beers[1]->kind = $kinds[2];
$beers[1]->strengh = 4;
$kinds[2]->ownBeer[] = $beers[1];

$beers[2]->name = 'Chimay Bleue';
$beers[2]->kind = $kinds[1];
$beers[2]->strengh = 5;
$kinds[1]->ownBeer[] = $beers[2];

$beers[3]->name = 'Leffe';
$beers[3]->kind = $kinds[0];
$beers[3]->strengh = 6.5;
$kinds[0]->ownBeer[] = $beers[3];

$beers[4]->name = 'Heineken';
$beers[4]->kind = $kinds[2];
$beers[4]->strengh = 6.5;
$kinds[2]->ownBeer[] = $beers[4];

R::storeAll($beers);
R::storeAll($kinds);

echo 'il y a '. count($kinds[0]->ownBeer). " blondes \n";
$keys = array_keys($kinds[0]->with('ORDER BY name DESC')->ownBeer);
//var_dump($keys);
echo 'La première est '. $kinds[0]->ownBeer[$keys[0]]->name. "\n";