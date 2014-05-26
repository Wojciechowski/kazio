<?php
Doo::loadCore('db/DooModel');

class DaneMailTestBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 250.
     */
    public $mail;

    /**
     * @var datetime
     */
    public $data;

    public $_table = 'dane_mail_test';
    public $_primarykey = 'id';
    public $_fields = array('id','mail','data');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'mail' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'data' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                )
            );
    }

}