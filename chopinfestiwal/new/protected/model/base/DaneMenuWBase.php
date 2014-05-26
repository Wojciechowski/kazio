<?php
Doo::loadCore('db/DooModel');

class DaneMenuWBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id_m;

    /**
     * @var int Max length is 11.
     */
    public $menu;

    /**
     * @var int Max length is 11.
     */
    public $podmenu;

    /**
     * @var int Max length is 11.
     */
    public $lp;

    /**
     * @var int Max length is 1.
     */
    public $jest;

    public $_table = 'dane_menu_w';
    public $_primarykey = 'id_m';
    public $_fields = array('id_m','menu','podmenu','lp','jest');

    public function getVRules() {
        return array(
                'id_m' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'menu' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'podmenu' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'lp' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
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