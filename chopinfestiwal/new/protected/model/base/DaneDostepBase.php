<?php
Doo::loadCore('db/DooModel');

class DaneDostepBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $aid;

    /**
     * @var varchar Max length is 20.
     */
    public $dzial;

    public $_table = 'dane_dostep';
    public $_primarykey = '';
    public $_fields = array('aid','dzial');

    public function getVRules() {
        return array(
                'aid' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'dzial' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                )
            );
    }

}