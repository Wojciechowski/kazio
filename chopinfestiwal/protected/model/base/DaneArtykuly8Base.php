<?php
Doo::loadCore('db/DooModel');

class DaneArtykuly8Base extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 1.
     */
    public $grupa;

    /**
     * @var tinyint Max length is 1.
     */
    public $wstep;

    /**
     * @var tinyint Max length is 1.
     */
    public $lp_wstep;

    /**
     * @var tinyint Max length is 1.
     */
    public $lp;

    /**
     * @var varchar Max length is 255.
     */
    public $tytul;

    /**
     * @var text
     */
    public $tresc1;

    /**
     * @var text
     */
    public $tresc2;

    /**
     * @var text
     */
    public $foto;

    /**
     * @var varchar Max length is 150.
     */
    public $class;

    /**
     * @var date
     */
    public $data;

    /**
     * @var date
     */
    public $zmiana;

    /**
     * @var varchar Max length is 255.
     */
    public $tytul_f;

    /**
     * @var text
     */
    public $tresc1_f;

    /**
     * @var text
     */
    public $tresc2_f;

    /**
     * @var tinyint Max length is 1.
     */
    public $wtrakcie;

    /**
     * @var tinyint Max length is 1.
     */
    public $jest;

    /**
     * @var tinyint Max length is 1.
     */
    public $format;

    public $_table = 'dane_artykuly8';
    public $_primarykey = 'id';
    public $_fields = array('id','grupa','wstep','lp_wstep','lp','tytul','tresc1','tresc2','foto','class','data','zmiana','tytul_f','tresc1_f','tresc2_f','wtrakcie','jest','format');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'grupa' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'wstep' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'lp_wstep' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'lp' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'tytul' => array(
                        array( 'maxlength', 255 ),
                        array( 'notnull' ),
                ),

                'tresc1' => array(
                        array( 'notnull' ),
                ),

                'tresc2' => array(
                        array( 'optional' ),
                ),

                'foto' => array(
                        array( 'notnull' ),
                ),

                'class' => array(
                        array( 'maxlength', 150 ),
                        array( 'notnull' ),
                ),

                'data' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'zmiana' => array(
                        array( 'date' ),
                        array( 'notnull' ),
                ),

                'tytul_f' => array(
                        array( 'maxlength', 255 ),
                        array( 'optional' ),
                ),

                'tresc1_f' => array(
                        array( 'optional' ),
                ),

                'tresc2_f' => array(
                        array( 'optional' ),
                ),

                'wtrakcie' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'jest' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'format' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                )
            );
    }

}