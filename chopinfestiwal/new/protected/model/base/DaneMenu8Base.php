<?php
Doo::loadCore('db/DooModel');

class DaneMenu8Base extends DooModel {

  /**
   * @var int Max length is 11.
   */
  public $id;

  /**
   * @var int Max length is 11.
   */
  public $grupa;

  /**
   * @var varchar Max length is 100.
   */
  public $nazwa;

  /**
   * @var varchar Max length is 150.
   */
  public $link;

  /**
   * @var varchar Max length is 15.
   */
  public $okno;

  /**
   * @var int Max length is 1.
   */
  public $pod_m;

  /**
   * @var int Max length is 11.
   */
  public $lp;

  /**
   * @var tinyint Max length is 1.
   */
  public $poziom;

  /**
   * @var varchar Max length is 50.
   */
  public $class;

  /**
   * @var varchar Max length is 30.
   */
  public $icon;

  /**
   * @var int Max length is 1.
   */
  public $test;

  /**
   * @var char Max length is 1.
   */
  public $jest;

  public $_table = 'dane_menu8';
  public $_primarykey = 'id';
  public $_fields = array('id','grupa','nazwa','link','okno','pod_m','lp','poziom','class','icon','test','jest');

  public function getVRules() {
    return array(
      'id' => array(
        array( 'integer' ),
        array( 'maxlength', 11 ),
        array( 'optional' ),
      ),

      'grupa' => array(
        array( 'integer' ),
        array( 'maxlength', 11 ),
        array( 'notnull' ),
      ),

      'nazwa' => array(
        array( 'maxlength', 100 ),
        array( 'notnull' ),
      ),

      'link' => array(
        array( 'maxlength', 150 ),
        array( 'notnull' ),
      ),

      'okno' => array(
        array( 'maxlength', 15 ),
        array( 'optional' ),
      ),

      'pod_m' => array(
        array( 'integer' ),
        array( 'maxlength', 1 ),
        array( 'notnull' ),
      ),

      'lp' => array(
        array( 'integer' ),
        array( 'maxlength', 11 ),
        array( 'notnull' ),
      ),

      'poziom' => array(
        array( 'integer' ),
        array( 'maxlength', 1 ),
        array( 'notnull' ),
      ),

      'class' => array(
        array( 'maxlength', 50 ),
        array( 'notnull' ),
      ),

      'icon' => array(
        array( 'maxlength', 30 ),
        array( 'notnull' ),
      ),

      'test' => array(
        array( 'integer' ),
        array( 'maxlength', 1 ),
        array( 'notnull' ),
      ),

      'jest' => array(
        array( 'maxlength', 1 ),
        array( 'notnull' ),
      )
    );
  }

}