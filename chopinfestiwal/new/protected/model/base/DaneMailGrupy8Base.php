<?php
Doo::loadCore('db/DooModel');

class DaneMailGrupy8Base extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var tinyint Max length is 4.
     */
    public $szyk;

    /**
     * @var varchar Max length is 150.
     */
    public $nazwa;

    /**
     * @var text
     */
    public $opis;

    public $_table = 'dane_mail_grupy8';
    public $_primarykey = 'id';
    public $_fields = array('id','szyk','nazwa','opis');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'szyk' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'nazwa' => array(
                        array( 'maxlength', 150 ),
                        array( 'notnull' ),
                ),

                'opis' => array(
                        array( 'optional' ),
                )
            );
    }

}