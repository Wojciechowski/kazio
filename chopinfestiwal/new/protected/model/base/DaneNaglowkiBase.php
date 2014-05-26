<?php
Doo::loadCore('db/DooModel');

class DaneNaglowkiBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $dzial;

    /**
     * @var varchar Max length is 250.
     */
    public $temat;

    /**
     * @var int Max length is 1.
     */
    public $test;

    /**
     * @var int Max length is 1.
     */
    public $aktyw;

    public $_table = 'dane_naglowki';
    public $_primarykey = 'id';
    public $_fields = array('id','dzial','temat','test','aktyw');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'dzial' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'temat' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'test' => array(
                        array( 'integer' ),
                        array( 'maxlength', 1 ),
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