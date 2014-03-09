<?php
/**
 * Example Database connection settings and DB relationship mapping
 * $dbmap[Table A]['has_one'][Table B] = array('foreign_key'=> Table B's column that links to Table A );
 * $dbmap[Table B]['belongs_to'][Table A] = array('foreign_key'=> Table A's column where Table B links to );
 

//Food relationship
$dbmap['Food']['belongs_to']['FoodType'] = array('foreign_key'=>'id');
$dbmap['Food']['has_many']['Article'] = array('foreign_key'=>'food_id');
$dbmap['Food']['has_one']['Recipe'] = array('foreign_key'=>'food_id');
$dbmap['Food']['has_many']['Ingredient'] = array('foreign_key'=>'food_id', 'through'=>'food_has_ingredient');

//Food Type
$dbmap['FoodType']['has_many']['Food'] = array('foreign_key'=>'food_type_id');

//Article
$dbmap['Article']['belongs_to']['Food'] = array('foreign_key'=>'id');

//Recipe
$dbmap['Recipe']['belongs_to']['Food'] = array('foreign_key'=>'id');

//Ingredient
$dbmap['Ingredient']['has_many']['Food'] = array('foreign_key'=>'ingredient_id', 'through'=>'food_has_ingredient');

*/

$dbmap['DaneKomunikaty']['has_many']['DaneKomunikatyText'] = array('foreign_key'=>'id');
$dbmap['DaneKomunikatyText']['belongs_to']['DaneKomunikaty'] = array('foreign_key'=>'artykul');

$dbmap['DaneMenuF']['has_many']['DaneMenu8'] = array('foreign_key'=>'id');
$dbmap['DaneMenu8']['belongs_to']['DaneMenuF'] = array('foreign_key'=>'id_m');

/*
$dbmap['Food']['has_many']['Article'] = array('foreign_key'=>'food_id');
$dbmap['Article']['belongs_to']['Food'] = array('foreign_key'=>'id');
*/


//$dbconfig['dev'] = array('localhost', 'kazio', 'joomla', 'joomla', 'mysql', true, 'charset' => 'latin2');
$dbconfig['dev'] = array('localhost', 'kazio_dane1', 'kazio_0413', 'reg741', 'mysql', true);
$dbconfig['prod'] = array('localhost', 'kazio_dane1', 'kazio_0413', 'reg741', 'mysql', true);

?>