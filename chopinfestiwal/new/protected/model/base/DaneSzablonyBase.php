<?php
Doo::loadCore('db/DooModel');

class DaneSzablonyBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 25.
     */
    public $nazwa;

    /**
     * @var varchar Max length is 50.
     */
    public $plik;

    /**
     * @var tinyint Max length is 1.
     */
    public $aktyw;

    public $_table = 'dane_szablony';
    public $_primarykey = 'id';
    public $_fields = array('id','nazwa','plik','aktyw');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nazwa' => array(
                        array( 'maxlength', 25 ),
                        array( 'notnull' ),
                ),

                'plik' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                ),

                'aktyw' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}