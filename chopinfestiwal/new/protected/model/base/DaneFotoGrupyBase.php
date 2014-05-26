<?php
Doo::loadCore('db/DooModel');

class DaneFotoGrupyBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 150.
     */
    public $sciezka;

    /**
     * @var tinyint Max length is 4.
     */
    public $jest;

    public $_table = 'dane_foto_grupy';
    public $_primarykey = 'id';
    public $_fields = array('id','sciezka','jest');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'sciezka' => array(
                        array( 'maxlength', 150 ),
                        array( 'notnull' ),
                ),

                'jest' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                )
            );
    }

}