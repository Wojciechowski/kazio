<?php
/**
 * MainController
 * Main site control
 *
 * @author Piotr Wojciechowski
 * @copyright Copyright (C) 2013
 */

class MainController extends DooController{

    public $data;

    function __construct() {
        $this->data['app_url'] = Doo::conf()->APP_URL;
    }

    public function index(){
        $this->data['group'] = (isset($_GET['grupa'])) ? $_GET['grupa']: 1;
        $this->data['section'] = (isset($_GET['dzial'])) ? $_GET['dzial']: 51;

        $this->menu();

        // współorganizatorzy
        $banner = Doo::db()->find('DaneArtykuly8', array('where' => 'grupa = 199 AND jest = 1', 'limit' => 1));
        if ($banner) {
            $this->data['topbanner'] = $this->parseContent($banner);
        }

        // sponsorzy
        $banner2 = Doo::db()->find('DaneArtykuly8', array('where' => 'grupa = 181 AND jest = 1', 'limit' => 1));
        if ($banner2) {
            $this->data['bottombanner'] = $this->parseContent($banner2);
        }
//        $this->data['print'] = print_r($banner2);

        // Slideshow
        $dir = 'foto/slajdy/';
        $dh = opendir($dir);
        $files = '';
        while (($file = readdir($dh)) !== false) {
            if (!is_dir($dir.$file) && !preg_match('/\.(html|htm|php)/', $file)){
                $files .= '<img src="'.$dir.$file.'" alt="">';
            }
        }
        $this->data['slideshow'] = '<div id="slideshow">'.$files.'</div>';

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
                        $img = "<img src=\"$path$plik[0]\" style=\"width:{$width}px;height:{$height}px\" alt=\"\">";
                        if ($plik[1] == 1) {
                            if ($d) {
                                $click = " onclick=\"foto('$d')\"";
                            } else {
                                $click = '';
                            }
                            $img = "<span class=\"foto_{$plik[2]}\" style=\"width:{$width}px;height:{$height}px\"$click>$img</span>";
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
                    $img = "<img src=\"$path$plik[0]\" style=\"width:{$width}px;height:{$height}px\" alt=\"\">";
                    if ($plik[1] == 1) {
                        if ($d) {
                            $click = " onclick=\"foto('$d')\"";
                        } else {
                            $click = '';
                        }
                        $img = "<span class=\"foto_{$plik[2]}\" style=\"width:{$width}px;height:{$height}px\"$click>$img</span>";
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
        $this->data['bodyClass'] .= ((!isset($_GET['dzial']) || $_GET['dzial'] == 51) ? ' home': '');

        $menu = $DaneMenuF->relate('DaneMenu8', array('where'=>'menu = 1 AND dane_menu_f.jest = 1', 'asc'=>'dane_menu_f.lp'));
        foreach ($menu as $row) {
            if ($row->id_m == $this->data['section']) {
                $this->data['sectionTitle'] = $row->DaneMenu8[0]->nazwa;

            }
            if ($row->podmenu) {
                $row->submenu = $DaneMenuF->relate('DaneMenu8', array('where'=>'menu = ' . $row->id_m . ' AND dane_menu_f.jest = 1', 'asc'=>'dane_menu_f.lp'));
            }
            $this->data['menu'][] = $row;
        }
        //$this->data['print'] = "test\n" . print_r($menu, true);
    }

}

