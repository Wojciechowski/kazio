<?php
Doo::loadCore('db/DooModel');

class DaneParafiaBase extends DooModel{

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $id;

    /**
     * @var varchar Max length is 100.
     */
    public $tytul;

    /**
     * @var mediumtext
     */
    public $tresc1;

    /**
     * @var mediumtext
     */
    public $tresc2;

    /**
     * @var varchar Max length is 250.
     */
    public $tytul_f;

    /**
     * @var mediumtext
     */
    public $tresc1_f;

    /**
     * @var text
     */
    public $tresc2_f;

    /**
     * @var int Max length is 11.
     */
    public $front;

    /**
     * @var tinyint Max length is 4.
     */
    public $format;

    /**
     * @var tinyint Max length is 3.
     */
    public $state;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $sectionid;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $mask;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $grupa;

    /**
     * @var datetime
     */
    public $data;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $autor;

    /**
     * @var varchar Max length is 100.
     */
    public $created_by_alias;

    /**
     * @var datetime
     */
    public $modified;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $modified_by;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $checked_out;

    /**
     * @var datetime
     */
    public $checked_out_time;

    /**
     * @var datetime
     */
    public $publish_up;

    /**
     * @var datetime
     */
    public $publish_down;

    /**
     * @var text
     */
    public $images;

    /**
     * @var text
     */
    public $urls;

    /**
     * @var text
     */
    public $attribs;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $version;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $parentid;

    /**
     * @var int Max length is 11.
     */
    public $lp;

    /**
     * @var text
     */
    public $metakey;

    /**
     * @var text
     */
    public $metadesc;

    /**
     * @var tinyint Max length is 1.  unsigned.
     */
    public $kosz;

    /**
     * @var int Max length is 11.  unsigned.
     */
    public $hits;

    /**
     * @var tinyint Max length is 1.
     */
    public $jest;

    public $_table = 'dane_parafia';
    public $_primarykey = 'id';
    public $_fields = array('id','tytul','tresc1','tresc2','tytul_f','tresc1_f','tresc2_f','front','format','state','sectionid','mask','grupa','data','autor','created_by_alias','modified','modified_by','checked_out','checked_out_time','publish_up','publish_down','images','urls','attribs','version','parentid','lp','metakey','metadesc','kosz','hits','jest');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'tytul' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'tresc1' => array(
                        array( 'notnull' ),
                ),

                'tresc2' => array(
                        array( 'notnull' ),
                ),

                'tytul_f' => array(
                        array( 'maxlength', 250 ),
                        array( 'notnull' ),
                ),

                'tresc1_f' => array(
                        array( 'notnull' ),
                ),

                'tresc2_f' => array(
                        array( 'notnull' ),
                ),

                'front' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'format' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'notnull' ),
                ),

                'state' => array(
                        array( 'integer' ),
                        array( 'maxlength', 3 ),
                        array( 'notnull' ),
                ),

                'sectionid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'mask' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'grupa' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'data' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'autor' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'created_by_alias' => array(
                        array( 'maxlength', 100 ),
                        array( 'notnull' ),
                ),

                'modified' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'modified_by' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'checked_out' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'checked_out_time' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'publish_up' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'publish_down' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'images' => array(
                        array( 'notnull' ),
                ),

                'urls' => array(
                        array( 'notnull' ),
                ),

                'attribs' => array(
                        array( 'notnull' ),
                ),

                'version' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'parentid' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'lp' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'metakey' => array(
                        array( 'notnull' ),
                ),

                'metadesc' => array(
                        array( 'notnull' ),
                ),

                'kosz' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
                        array( 'maxlength', 1 ),
                        array( 'notnull' ),
                ),

                'hits' => array(
                        array( 'integer' ),
                        array( 'min', 0 ),
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