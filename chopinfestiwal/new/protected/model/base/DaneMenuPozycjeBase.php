<?php
Doo::loadCore('db/DooModel');

class DaneMenuPozycjeBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var tinyint Max length is 4.
     */
    public $grupa;

    /**
     * @var varchar Max length is 100.
     */
    public $nazwa;

    /**
     * @var varchar Max length is 150.
     */
    public $link;

    /**
     * @var varchar Max length is 15.
     */
    public $okno;

    /**
     * @var int Max length is 11.
     */
    public $lp;

    /**
     * @var tinyint Max length is 4.
     */
    public $poziom;

    /**
     * @var int Max length is 1.
     */
    public $kosz;

    /**
     * @var tinyint Max length is 1.
     */
    public $jest;

    public $_table = 'dane_menu_pozycje';
    public $_primarykey = 'id';
    public $_fields = array('id','grupa','nazwa','link','okno','lp','poziom','kosz','jest');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'grupa' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'nazwa' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'link' => array(
                        array( 'maxlength', 150 ),
                        array( 'optional' ),
                ),

                'okno' => array(
                        array( 'maxlength', 15 ),
                        array( 'optional' ),
                ),

                'lp' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'poziom' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'kosz' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
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