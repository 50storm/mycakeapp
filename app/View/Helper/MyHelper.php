<?php
class MyHelper extends AppHelper {
  public $helpers = array('Html');

  function test(){
        return 'http://cakephp.jp/';                                                                                
  }
  
  function sidebar(){
    $sidebar='';
    $li_sign_up = '<li>'. $this->Html->link( __('サインアップ'), array('controller' => 'Users', 'action' => 'signup')).'</li>';
    $li_login = '<li>'. $this->Html->link( __('ログイン'), array('controller' => 'Users', 'action' => 'login')).'</li>';
    $sidebar ='<ul>'.
                  $li_sign_up.
                  $li_login.
              '</ul>';
    return $sidebar;

  }

 function sysName(){
  return '<h2>Hiro\'s System</h2>' ;
 } 

}
