<?php
Doo::loadCore('db/DooModel');

class DaneKomunikatyTextBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $aid;

    /**
     * @var date
     */
    public $data;

    /**
     * @var varchar Max length is 250.
     */
    public $tytul;

    /**
     * @var text
     */
    public $tresc;

    /**
     * @var int Max length is 1.
     */
    public $jest;

    public $_table = 'dane_komunikaty_text';
    public $_primarykey = 'id';
    public $_fields = array('id','aid','data','tytul','tresc','jest');

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

                'data' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'tytul' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'tresc' => array(
                        array( 'notnull' ),
                ),

                'jest' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}