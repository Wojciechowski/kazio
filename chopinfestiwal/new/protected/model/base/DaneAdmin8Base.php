<?php
Doo::loadCore('db/DooModel');

class DaneAdmin8Base extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 15.
     */
    public $login;

    /**
     * @var varchar Max length is 50.
     */
    public $imie;

    /**
     * @var varchar Max length is 50.
     */
    public $nazwisko;

    /**
     * @var varchar Max length is 100.
     */
    public $mail;

    /**
     * @var varchar Max length is 200.
     */
    public $haslo;

    /**
     * @var datetime
     */
    public $data;

    /**
     * @var char Max length is 1.
     */
    public $test;

    /**
     * @var tinyint Max length is 1.
     */
    public $poziom;

    /**
     * @var varchar Max length is 20.
     */
    public $zakres;

    /**
     * @var char Max length is 1.
     */
    public $jest;

    public $_table = 'dane_admin8';
    public $_primarykey = 'id';
    public $_fields = array('id','login','imie','nazwisko','mail','haslo','data','test','poziom','zakres','jest');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'login' => array(
                        array( 'maxlength', 15 ),
                        array( 'notnull' ),
                ),

                'imie' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'nazwisko' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'mail' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'haslo' => array(
                        array( 'maxlength', 200 ),
                        array( 'notnull' ),
                ),

                'data' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'test' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'poziom' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'zakres' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'jest' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}