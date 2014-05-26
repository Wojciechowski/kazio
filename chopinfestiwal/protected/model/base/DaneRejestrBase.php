<?php
Doo::loadCore('db/DooModel');

class DaneRejestrBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $aid;

    /**
     * @var varchar Max length is 250.
     */
    public $opis;

    /**
     * @var varchar Max length is 250.
     */
    public $lista;

    /**
     * @var int Max length is 11.
     */
    public $pozycja;

    /**
     * @var datetime
     */
    public $data;

    public $_table = 'dane_rejestr';
    public $_primarykey = 'id';
    public $_fields = array('id','aid','opis','lista','pozycja','data');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'aid' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'opis' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'lista' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'pozycja' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'data' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                )
            );
    }

}