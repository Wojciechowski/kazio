<?php
Doo::loadCore('db/DooModel');

class DaneHasla8Base extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id_strony;

    /**
     * @var varchar Max length is 30.
     */
    public $haslo;

    public $_table = 'dane_hasla8';
    public $_primarykey = 'id_strony';
    public $_fields = array('id_strony','haslo');

    public function getVRules() {
        return array(
                'id_strony' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'haslo' => array(
                        array( 'maxlength', 30 ),
                        array( 'notnull' ),
                )
            );
    }

}