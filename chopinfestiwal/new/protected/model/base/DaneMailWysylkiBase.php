<?php
Doo::loadCore('db/DooModel');

class DaneMailWysylkiBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var datetime
     */
    public $data;

    /**
     * @var int Max length is 11.
     */
    public $a_id;

    /**
     * @var int Max length is 11.
     */
    public $t_id;

    /**
     * @var varchar Max length is 50.
     */
    public $warunek;

    /**
     * @var tinyint Max length is 4.
     */
    public $ilosc;

    public $_table = 'dane_mail_wysylki';
    public $_primarykey = 'id';
    public $_fields = array('id','data','a_id','t_id','warunek','ilosc');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'data' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'a_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                't_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'warunek' => array(
                        array( 'maxlength', 50 ),
                        array( 'optional' ),
                ),

                'ilosc' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                )
            );
    }

}