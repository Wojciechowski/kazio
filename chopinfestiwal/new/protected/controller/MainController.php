<?php
/**
 * MainController
 * Main site control
 *
 * @author Piotr Wojciechowski
 * @copyright Copyright (C) 2013/2014
 */

class MainController extends DooController{

    public $data;
    public $home;

    function __construct() {
        $this->data['app_url'] = Doo::conf()->APP_URL;
    }

    public function index(){
        $wspolorganizatorzy = 202;// ID diału z listą współorganizatoów
        $glownybaner = 203;// ID diału z obrazkami banera
        $media = 204;// ID diału z patronatami medialnymi

        $this->data['group'] = (isset($_GET['grp'])) ? $_GET['grp']: 1;
        $this->data['section'] = (isset($_GET['dzial'])) ? $_GET['dzial']: 51;

        $this->data['print'] = "grup: ".$this->data['group'].", section: ".$this->data['section'];

            $this->menu();

        // współorganizatorzy
        $banner = Doo::db()->find('DaneArtykuly8', array('where' => 'grupa = '.$wspolorganizatorzy, 'limit' => 1));
//        $banner = Doo::db()->find('DaneArtykuly8', array('where' => 'grupa = '.$wspolorganizatorzy.' AND jest = 1', 'limit' => 1));
        if ($banner) {
            $this->data['topbanner'] = $this->parseContent($banner);
        }

        // główny baner
        $banner2 = Doo::db()->find('DaneArtykuly8', array('where' => 'grupa = '.$glownybaner.' AND jest = 1', 'desc' => 'id', 'limit' => 1));
        if ($banner2) {
            $this->data['mainbanner'] = $this->parseContent($banner2);
        }

        // media
        $banner3 = Doo::db()->find('DaneArtykuly8', array('where' => 'grupa = '.$media, 'desc' => 'id', 'limit' => 1));
//        $banner3 = Doo::db()->find('DaneArtykuly8', array('where' => 'grupa = '.$media.' AND jest = 1', 'desc' => 'id', 'limit' => 1));
        if ($banner3) {
            $this->data['bottombanner'] = $this->parseContent($banner3);
        }
//        $this->data['print'] = print_r($banner2);

        /*// Slideshow
        $dir = '../foto/slajdy/';
        $dh = opendir($dir);
        $files = '';
        while (($file = readdir($dh)) !== false) {
            if (!is_dir($dir.$file) && !preg_match('/\.(html|htm|php)/', $file)){
                $files .= '<img src="'.$dir.$file.'" alt="">';
            }
        }
        $this->data['slideshow'] = '<div id="slideshow">'.$files.'</div>';*/

        // treść
        if ($this->data['section'] == 51) {
            // strona główna
            $where = '(grupa = ' . $this->data['section'] . ' OR wstep = 2) AND jest = 1';
            $order = 'lp_wstep';
        } else {
            $where = 'grupa = ' . $this->data['section'] . ' AND jest = 1';
            $order = 'lp';
        }

        $articles = Doo::db()->find('DaneArtykuly8', array('where' => $where, 'asc' => $order));

        $lenght = count($articles);
        $search = array ('/( [azwoi]) /i',
            '/(„[azwoi]) /i',
            '/("[azwoi]) /i',
            '/&lt;/',
            '/&gt;/',
            '/&prime;/',
            '/&quot;/',
            '/\n+/');
        $replace = array ('$1&nbsp;',
            '$1&nbsp;',
            '$1&nbsp;',
            '<',
            '>',
            "'",
            '"',
            '<br>');
        $pat = '/\{wstawFoto\}/';

        foreach ($articles as $row) {
            if ($row->grupa == $this->data['section']) {
                $text = $row->tresc1 . "\n" . $row->tresc2;
            } else {
                $text = $row->tresc1 . (($row->tresc2 != '') ? ' <a href="' . $this->data['app_url'] . '?grp=&dzial=' . $row->grupa . '#art' . $row->id . '">>>></a>': '');
            }

            $text = preg_replace($search, $replace, $text);

            if (preg_match($pat, $text)) {
                $t_foto = preg_split("/[\n,]/", $row->foto);
                $t_text = preg_split($pat, $text);
                $text = '';
                foreach ($t_text as $k => $w) {
                    $text .= $w;
                    $d = '';
                    if (isset($t_foto[$k]) && preg_match('/|/', $t_foto[$k])) {
                        $plik = explode('|', $t_foto[$k]);
                        //$path = preg_replace('/new\//', '', $this->data['app_url']);
                        $path = '../';
                        if (file_exists($path . $plik[0])) $d = $path . $plik[0];
                        $m = preg_replace('/\.(jpg|png|gif)$/i', '__.$1', $plik[0]);
                        if (file_exists($path . $m)) $plik[0] = $m;

                        list($width, $height, $type, $attr) = getimagesize($path . $plik[0]);
                        $img = "<img src=\"$path"
                            . "{$plik[0]}\" style=\"width:{$width}px;height:{$height}px\" alt=\"\">";
                        if ($plik[1] == 1) {
                            if ($d) {
                                $click = " onclick=\"foto('$d')\"";
                            } else {
                                $click = '';
                            }
                            $width += 16;
                            $height += 16;
                            $img = "<span class=\"foto_{$plik[2]}\" style=\"width:"
                                . "{$width}px;height:{$height}px\"$click>$img</span>";
                        }
                        $text .= $img;
                    }
                }
            } else if (preg_match('/\{File:(\w+):(\w+)(:.*)?\}{1}/', $text, $dane)) {
                include_once($dane[1].'.php');
                $parametr = ($dane[3]) ? $dane[3]: '';
                $zmiana = $dane[2]($parametr);
                $text = preg_replace('/\{File:\w+:\w+(:\w+)?\}{1}/', $zmiana, $text);
            }
            $this->data['articles'][] = array('id' => $row->id, 'title' => $row->tytul, 'content' => $text, 'class' => $row->class);
            if (!$this->home && $lenght > 1) {
                $this->data['list'][] = array('id' => $row->id, 'title' => $row->tytul);
            }
        }

        $update = Doo::db()->find('DaneAktualizacja', array('where' => 'gdzie = 2', 'desc' => 'czas', 'limit' => 1));
        $this->data['update'] = $update->czas;

        $this->render('main', $this->data);
    }

    private function parseContent($row) {
        $search = array ('/( [azwoi]) /i',
            '/(„[azwoi]) /i',
            '/("[azwoi]) /i',
            '/&lt;/',
            '/&gt;/',
            '/&prime;/',
            '/&quot;/');
        $replace = array ('$1&nbsp;',
            '$1&nbsp;',
            '$1&nbsp;',
            '<',
            '>',
            "'",
            '"');
        $pat = '/\{wstawFoto\}/';

        if ($row->grupa == $this->data['section']) {
            $text = $row->tresc1 . "\n" . $row->tresc2;
        } else {
            $text = $row->tresc1 . (($row->tresc2 != '') ? ' <a href="' . $this->data['app_url'] . '?grp=&dzial=' . $row->grupa . '#art' . $row->id . '">>>></a>': '');
        }

        $text = preg_replace($search, $replace, $text);
        if (preg_match('#</p>|<br>#', $text)) {
            $text = preg_replace('/(\n\n)+/', '<br>', $text);
        } else {
            $text = preg_replace('/\n+/', '<br>', $text);
        }

        if (preg_match($pat, $text)) {
            // wstawianie obrazków
            $t_foto = preg_split("/[\n,]/", $row->foto);
            $t_text = preg_split($pat, $text);
            $text = '';
            for ($k = 0, $end = count($t_text) - 1; $k < $end; $k++) {
                $w = $t_text[$k];
                $text .= $w;
                $d = '';
                if (isset($t_foto[$k]) && preg_match('/|/', $t_foto[$k])) {
                    $plik = explode('|', $t_foto[$k]);
                    $path = '../';
                    if (file_exists($path . $plik[0])) $d = $path . $plik[0];
                    $m = preg_replace('/\.(jpg|png|gif)$/i', '__.$1', $plik[0]);
                    if (file_exists($path . $m)) $plik[0] = $m;

                    list($width, $height, $type, $attr) = getimagesize($path . $plik[0]);
                    $img = "<img src=\"$path{$plik[0]}\" style=\"width:"
                        . "{$width}px;height:{$height}px\" alt=\"\">";
                    if ($plik[1] == 1) {
                        if ($d) {
                            $click = " onclick=\"foto('$d')\"";
                        } else {
                            $click = '';
                        }
                        $img = "<span class=\"foto_{$plik[2]}\" style=\"width:"
                            . "{$width}px;height:{$height}px\"$click>$img</span>";
                    }
                    $text .= $img;
                }
            }
        } else if (preg_match('/\{File:(\w+):(\w+)(:.*)?\}{1}/', $text, $dane)) {
            include_once($dane[1].'.php');
            $parametr = ($dane[3]) ? $dane[3]: '';
            $zmiana = $dane[2]($parametr);
            $text = preg_replace('/\{File:\w+:\w+(:\w+)?\}{1}/', $zmiana, $text);
        }
        return array('id' => $row->id, 'title' => $row->tytul, 'content' => $text, 'class' => $row->class);
    }

    public function menu(){
        Doo::loadModel('DaneMenuF');
        $DaneMenuF = new DaneMenuF;

        $this->data['bodyClass'] = 'grp' . ((isset($_GET['grp'])) ? $_GET['grp']: 1);
        $this->data['bodyClass'] .= ' dzial' . $this->data['section'];
        if (!isset($_GET['dzial']) || $_GET['dzial'] == 51) {
            $this->data['bodyClass'] .= ' home';
            $this->home = true;
        }

        $menu = $DaneMenuF->relate('DaneMenu8', array('where'=>'menu = 1 AND dane_menu_f.jest = 1', 'asc'=>'dane_menu_f.lp'));

        foreach ($menu as $row) {
            if ($row->id_m == $this->data['section']) {
                $this->data['sectionTitle'] = $row->DaneMenu8[0]->nazwa;
                $this->data['print'] .= '<br>a: '.$row->id_m.' = '.$this->data['sectionTitle'];
            }
            if ($row->id_m == $this->data['group']) {
                $this->data['subTitle'] = $row->DaneMenu8[0]->nazwa;
                $this->data['subUrl'] = '?grp=1&dzial=' . $row->id_m;
                $this->data['print'] .= '<br>c: '.$row->id_m.' = '.$this->data['subTitle'];
            }
            if ($row->podmenu) {
                $row->submenu = $DaneMenuF->relate('DaneMenu8', array('where'=>'menu = ' . $row->id_m . ' AND dane_menu_f.jest = 1', 'asc'=>'dane_menu_f.lp'));
                if (count($row->submenu)) {
                    foreach ($row->submenu as $subrow) {
                        $subrow->submenu = $DaneMenuF->relate('DaneMenu8', array('where'=>'menu = ' . $subrow->id_m . ' AND dane_menu_f.jest = 1', 'asc'=>'dane_menu_f.lp'));
                        if ($subrow->id_m == $this->data['section']) {
                            $this->data['sectionTitle'] = $subrow->DaneMenu8[0]->nazwa;
                            $this->data['print'] .= '<br>a: '.$subrow->id_m.' = '.$this->data['sectionTitle'];
                        }
                        if ($subrow->id_m == $this->data['group']) {
                            $this->data['subTitle'] = $row->DaneMenu8[0]->nazwa;
                            $this->data['subUrl'] = '?grp=1&dzial=' . $row->id_m;
                            $this->data['subTitle2'] = $subrow->DaneMenu8[0]->nazwa;
                            $this->data['subUrl2'] = '?grp=1&dzial=' . $subrow->id_m;
                            foreach ($subrow->submenu as $subrow2) {
                                if ($subrow2->id_m == $this->data['section']) {
                                    $this->data['sectionTitle'] = $subrow2->DaneMenu8[0]->nazwa;
                                    $this->data['print'] .= '<br>a: '.$subrow2->id_m.' = '.$this->data['sectionTitle'];
                                    break;
                                }
                            }
                        }
                    }
                    $this->data['print'] .= '<br>b: '.count($row->submenu);

                }
            }
            $this->data['menu'][] = $row;
        }
    }

}

