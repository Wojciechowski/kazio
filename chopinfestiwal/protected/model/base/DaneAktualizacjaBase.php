<?php
Doo::loadCore('db/DooModel');

class DaneAktualizacjaBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var date
     */
    public $czas;

    /**
     * @var int Max length is 11.
     */
    public $kto;

    /**
     * @var tinyint Max length is 4.
     */
    public $gdzie;

    public $_table = 'dane_aktualizacja';
    public $_primarykey = 'czas';
    public $_fields = array('id','czas','kto','gdzie');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'czas' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'kto' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'gdzie' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                )
            );
    }

}