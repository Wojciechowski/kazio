<?php
Doo::loadCore('db/DooModel');

class DaneMailTresc8Base extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $aid;

    /**
     * @var varchar Max length is 250.
     */
    public $temat;

    /**
     * @var text
     */
    public $tresc;

    /**
     * @var datetime
     */
    public $data;

    /**
     * @var datetime
     */
    public $wyslane;

    /**
     * @var tinyint Max length is 1.
     */
    public $archiwum;

    /**
     * @var tinyint Max length is 1.
     */
    public $kosz;

    public $_table = 'dane_mail_tresc8';
    public $_primarykey = 'id';
    public $_fields = array('id','aid','temat','tresc','data','wyslane','archiwum','kosz');

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

                'temat' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'tresc' => array(
                        array( 'notnull' ),
                ),

                'data' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'wyslane' => array(
                        array( 'datetime' ),
                        array( 'optional' ),
                ),

                'archiwum' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'kosz' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}