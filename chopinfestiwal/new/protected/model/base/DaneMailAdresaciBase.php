<?php
Doo::loadCore('db/DooModel');

class DaneMailAdresaciBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $aid;

    /**
     * @var varchar Max length is 150.
     */
    public $imie;

    /**
     * @var varchar Max length is 250.
     */
    public $nazwisko;

    /**
     * @var varchar Max length is 250.
     */
    public $mail;

    /**
     * @var varchar Max length is 250.
     */
    public $firma;

    /**
     * @var text
     */
    public $nota;

    /**
     * @var tinyint Max length is 1.
     */
    public $grupa;

    /**
     * @var datetime
     */
    public $data;

    /**
     * @var tinyint Max length is 1.
     */
    public $aktyw;

    public $_table = 'dane_mail_adresaci';
    public $_primarykey = 'id';
    public $_fields = array('id','aid','imie','nazwisko','mail','firma','nota','grupa','data','aktyw');

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

                'imie' => array(
                        array( 'maxlength', 150 ),
                        array( 'optional' ),
                ),

                'nazwisko' => array(
                        array( 'maxlength', 250 ),
                        array( 'optional' ),
                ),

                'mail' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'firma' => array(
                        array( 'maxlength', 250 ),
                        array( 'optional' ),
                ),

                'nota' => array(
                        array( 'optional' ),
                ),

                'grupa' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'data' => array(
                        array( 'datetime' ),
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