<?php
Doo::loadCore('db/DooModel');

class DaneDzialyBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 250.
     */
    public $tekst;

    public $_table = 'dane_dzialy';
    public $_primarykey = 'id';
    public $_fields = array('id','tekst');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'tekst' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                )
            );
    }

}