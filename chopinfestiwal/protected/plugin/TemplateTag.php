<?php

//register global/PHP functions to be used with your template files
//You can move this to common.conf.php   $config['TEMPLATE_GLOBAL_TAGS'] = array('isset', 'empty');
//Every public static methods in TemplateTag class (or tag classes from modules) are available in templates without the need to define in TEMPLATE_GLOBAL_TAGS 
Doo::conf()->TEMPLATE_GLOBAL_TAGS = array('submenu', 'mainmenu', 'createForm', 'breadcrumbList', 'createList', 'pre', 'upper', 'tofloat', 'sample_with_args', 'debug', 'url', 'url2', 'function_deny', 'isset', 'empty');

function submenu($list, $app_url, $section)
{
    $submenu = '';
    foreach ($list as $row) {
        $submenu .= '<li' . (($section == $row->id_m) ? ' class="active"' : '') . '><a href="'
            . $app_url . '?grp=' . $row->menu . '&dzial=' . $row->id_m . '">'
            . $row->DaneMenu8[0]->nazwa . '</a>';
        if (count($row->submenu)) {
//            $submenu .= "<pre>".print_r($row->submenu, true)."</pre>";
            $submenu .= '<ul>';
            foreach ($row->submenu as $subrow) {
                $submenu .= '<li' . (($section == $subrow->id_m) ? ' class="active"' : '') . '><a href="'
                    . $app_url . '?grp=' . $subrow->menu . '&dzial=' . $subrow->id_m . '">'
                    . $subrow->DaneMenu8[0]->nazwa . '</a>';
                $submenu .= '</li>';
            }
            $submenu .= '</ul>';
        }
        $submenu .= '</li>';
    }
    return $submenu;
}

// kreowanie głównego menu
function mainmenu($list, $app_url, $section)
{
    $submenu = '';
    foreach ($list as $row) {
        if ($row->DaneMenu8[0]->link) {
            $submenu .= '<li><a href="'
                . $row->DaneMenu8[0]->link . '">'
                . $row->DaneMenu8[0]->nazwa . '</a>';
        } else {
            $submenu .= '<li' . (($section == $row->id_m) ? ' class="active"' : '') . '><a href="'
                . $app_url . '?grp=' . $row->menu . '&dzial=' . $row->id_m . '">'
                . $row->DaneMenu8[0]->nazwa . '</a>';
            if (isset($row->submenu)) {
                $submenu .= '<ul>';
                foreach ($row->submenu as $subrow) {
                    $submenu .= '<li' . (($section == $subrow->id_m) ? ' class="active"' : '') . '><a href="'
                        . $app_url . '?grp=' . $subrow->menu . '&dzial=' . $subrow->id_m . '">'
                        . $subrow->DaneMenu8[0]->nazwa . '</a>';
                    if (count($subrow->submenu)) {
                        $submenu .= '<ul>';
                        foreach ($subrow->submenu as $subrow2) {
                            $submenu .= '<li' . (($section == $subrow2->id_m) ? ' class="active"' : '') . '><a href="'
                                . $app_url . '?grp=' . $subrow2->menu . '&dzial=' . $subrow2->id_m . '">'
                                . $subrow2->DaneMenu8[0]->nazwa . '</a>';
                            $submenu .= '</li>';
                        }
                        $submenu .= '</ul>';
                    }
                    $submenu .= '</li>';
                }
                $submenu .= '</ul>';
            }
        }
        $submenu .= '</li>';
    }
    return '<ul>' . $submenu . '</ul>';
}


//////// admin ??????

function createForm($data) {
  if (is_array($data)) {
    $form = '<form class="form-horizontal">';
    foreach ($data as $val) {
      $value = (isset($val['value'])) ? $val['value']: '';

      $requiredBox = $required = $tooltip = '';
      if (isset($val['required'])) {
        $requiredBox = tooltip($val['required'], 'required');
        $required = ' required';
        //$tooltip = ' data-toggle="tooltip" title="'.$val['required'].'"';
      }

      if (isset($val['error'])) {
        $requiredBox .= tooltip($val['error'], 'error');
        //$tooltip = ' error="'.$val['error'].'"';
      }

      if (isset($val['input'])) {
        if ($val['input'] == 'hidden') {
          $form .= <<<BLOCK
<input type="{$val['input']}" id="{$val['name']}" name="{$val['name']}" value="$value">
BLOCK;

        } else {
          $form .= <<<BLOCK
<div class="control-group">
<label class="control-label" for="{$val['name']}">{$val['label']}:</label>
<div class="controls">
<input type="{$val['input']}" id="{$val['name']}" name="{$val['name']}" value="$value" placeholder="{$val['label']}"$required$tooltip>
$requiredBox</div>
</div>
BLOCK;

        }
      } else if (isset($val['button'])) {
        $class = (isset($val['class'])) ? " {$val['class']}": '';
        $attr = (isset($val['attr'])) ? " {$val['attr']}": '';
        $form .= <<<BLOCK
<div class="control-group">
<div class="controls">
<button type="{$val['button']}" id="{$val['name']}" class="btn$class"$attr>{$val['value']}</button>
</div>
</div>
BLOCK;

      }
    }
    return $form . "</form>";
  }
  return 'Wystąpił nieoczekiwany błąd!';
}

function tooltip($data, $class) {
  return '<div class="tooltip fade right '.$class.'"><div class="tooltip-arrow"></div><div class="tooltip-inner">'.$data.'</div></div>';
}

function breadcrumbList($data) {
  $length = count($data) - 1;
  $list = '';
  for ($i=0; $i<=$length; $i++) {
    if ($i == $length) {
      $list .= "<li>{$data[$i]['title']}</li>";
      //$first = false;
    } else {
      $list .= "<li><a href='{$data[$i]['url']}'>{$data[$i]['title']}</a> <span class='divider'>/</span></li>";
    }
  }
  return $list;
}

function createList($data) {
  $list = '<ul class="'.$data['class'].'">';
  foreach ($data['list'] as $val) {
    $icon = ($val['icon'] == '') ? '': '<i class="'.$val['icon'].'"></i> ';
    $target = ($val['target'] == '') ? '': ' target="'.$val['target'].'"';
    if ($val['submenu']) {
      $val['class'] .= ' dropdown';
      $val['submenu']['class'] .= ' dropdown-menu';
      $list .= '<li'.(($val['class'] == '') ? '': " class=\"{$val['class']}\"").'>'.$icon.'<a href="'.$val['link'].'"'.$target.'>'.$val['text'].'</a>';
      $list .= createList($val['submenu']);
      $list .= '</li>';
    } else {
      $list .= '<li'.(($val['class'] == '') ? '': " class=\"{$val['class']}\"").'>'.$icon.'<a href="'.$val['link'].'"'.$target.'>'.$val['text'].'</a></li>';
    }
  }
  $list .= '</ul>';
  return $list;
}

function pre($data) {
  $content = print_r($data);
  return "<pre>$content</pre>";
}

function upper($str){
    return strtoupper($str);
}

function tofloat($str){
    return sprintf("%.2f", $str);
}

function sample_with_args($str, $prefix){
    return $str .' with args: '. $prefix;
}

function debug($var){
    if(!empty($var)){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

//This will be called when a function NOT Registered is used in IF or ElseIF statment
function function_deny($var=null){
   echo '<span style="color:#ff0000;">Function denied in IF or ElseIF statement!</span>';
   exit;
}


//Build URL based on route id
function url($id, $param=null, $addRootUrl=false){
    Doo::loadHelper('DooUrlBuilder');
    // param pass in as string with format
    // 'param1=>this_is_my_value, param2=>something_here'

    if($param!=null){
        $param = explode(', ', $param);
        $param2 = null;
        foreach($param as $p){
            $splited = explode('=>', $p);
            $param2[$splited[0]] = $splited[1];
        }
        return DooUrlBuilder::url($id, $param2, $addRootUrl);
    }

    return DooUrlBuilder::url($id, null, $addRootUrl);
}


//Build URL based on controller and method name
function url2($controller, $method, $param=null, $addRootUrl=false){
    Doo::loadHelper('DooUrlBuilder');
    // param pass in as string with format
    // 'param1=>this_is_my_value, param2=>something_here'

    if($param!=null){
        $param = explode(', ', $param);
        $param2 = null;
        foreach($param as $p){
            $splited = explode('=>', $p);
            $param2[$splited[0]] = $splited[1];
        }
        return DooUrlBuilder::url2($controller, $method, $param2, $addRootUrl);
    }

    return DooUrlBuilder::url2($controller, $method, null, $addRootUrl);
}

?>