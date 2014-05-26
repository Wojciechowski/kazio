<?php
Doo::loadCore('db/DooModel');

class DaneOrkiestraBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $adresat_id;

    /**
     * @var int Max length is 11.
     */
    public $instrument_id;

    public $_table = 'dane_orkiestra';
    public $_primarykey = '';
    public $_fields = array('adresat_id','instrument_id');

    public function getVRules() {
        return array(
                'adresat_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'instrument_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}