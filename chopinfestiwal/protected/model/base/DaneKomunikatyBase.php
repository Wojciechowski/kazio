<?php
Doo::loadCore('db/DooModel');

class DaneKomunikatyBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $aid;

    /**
     * @var int Max length is 11.
     */
    public $artykul;

    public $_table = 'dane_komunikaty';
    public $_primarykey = '';
    public $_fields = array('aid','artykul');

    public function getVRules() {
        return array(
                'aid' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'artykul' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}