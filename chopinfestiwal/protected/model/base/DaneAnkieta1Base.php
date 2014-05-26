<?php
Doo::loadCore('db/DooModel');

class DaneAnkieta1Base extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 250.
     */
    public $nazwisko;

    /**
     * @var varchar Max length is 15.
     */
    public $u_data;

    /**
     * @var tinyint Max length is 1.
     */
    public $plec;

    /**
     * @var varchar Max length is 250.
     */
    public $u_instrument;

    /**
     * @var varchar Max length is 250.
     */
    public $adres;

    /**
     * @var varchar Max length is 150.
     */
    public $atel;

    /**
     * @var varchar Max length is 150.
     */
    public $tel_r;

    /**
     * @var varchar Max length is 250.
     */
    public $u_mail;

    /**
     * @var tinyint Max length is 1.
     */
    public $czyn;

    /**
     * @var tinyint Max length is 1.
     */
    public $klasa;

    /**
     * @var varchar Max length is 4.
     */
    public $zajecia2;

    /**
     * @var varchar Max length is 4.
     */
    public $zajecia3;

    /**
     * @var varchar Max length is 4.
     */
    public $zajecia4;

    /**
     * @var varchar Max length is 4.
     */
    public $zajecia5;

    /**
     * @var varchar Max length is 4.
     */
    public $zajecia6;

    /**
     * @var varchar Max length is 4.
     */
    public $zajecia7;

    /**
     * @var varchar Max length is 250.
     */
    public $stopien;

    /**
     * @var text
     */
    public $opis;

    /**
     * @var tinyint Max length is 1.
     */
    public $rezerwa;

    /**
     * @var int Max length is 11.
     */
    public $kwota;

    /**
     * @var tinyint Max length is 1.
     */
    public $rata;

    /**
     * @var varchar Max length is 15.
     */
    public $data;

    /**
     * @var varchar Max length is 250.
     */
    public $podpis;

    /**
     * @var varchar Max length is 250.
     */
    public $opieka;

    public $_table = 'dane_ankieta1';
    public $_primarykey = 'id';
    public $_fields = array('id','nazwisko','u_data','plec','u_instrument','adres','atel','tel_r','u_mail','czyn','klasa','zajecia2','zajecia3','zajecia4','zajecia5','zajecia6','zajecia7','stopien','opis','rezerwa','kwota','rata','data','podpis','opieka');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'nazwisko' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'u_data' => array(
                        array( 'maxlength', 15 ),
                        array( 'notnull' ),
                ),

                'plec' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'u_instrument' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'adres' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'atel' => array(
                        array( 'maxlength', 150 ),
                        array( 'notnull' ),
                ),

                'tel_r' => array(
                        array( 'maxlength', 150 ),
                        array( 'notnull' ),
                ),

                'u_mail' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'czyn' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'klasa' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'zajecia2' => array(
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'zajecia3' => array(
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'zajecia4' => array(
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'zajecia5' => array(
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'zajecia6' => array(
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'zajecia7' => array(
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'stopien' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'opis' => array(
                        array( 'optional' ),
                ),

                'rezerwa' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'kwota' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'rata' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'data' => array(
                        array( 'maxlength', 15 ),
                        array( 'notnull' ),
                ),

                'podpis' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'opieka' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                )
            );
    }

}