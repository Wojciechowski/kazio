<?php
Doo::loadCore('db/DooModel');

class DaneInstrumenty8Base extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $lp;

    /**
     * @var varchar Max length is 50.
     */
    public $nazwa;

    /**
     * @var tinyint Max length is 1.
     */
    public $jest;

    public $_table = 'dane_instrumenty8';
    public $_primarykey = 'id';
    public $_fields = array('id','lp','nazwa','jest');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'lp' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'nazwa' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'jest' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}