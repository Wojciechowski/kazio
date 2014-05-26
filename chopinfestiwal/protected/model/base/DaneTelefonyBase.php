<?php
Doo::loadCore('db/DooModel');

class DaneTelefonyBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $u_id;

    /**
     * @var varchar Max length is 1.
     */
    public $typ;

    /**
     * @var varchar Max length is 40.
     */
    public $telefon;

    public $_table = 'dane_telefony';
    public $_primarykey = 'id';
    public $_fields = array('id','u_id','typ','telefon');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'u_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'typ' => array(
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'telefon' => array(
                        array( 'maxlength', 40 ),
                        array( 'notnull' ),
                )
            );
    }

}