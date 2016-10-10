<?php
/*
表示系はこっちに記載。
更新系は、それぞれのコントローラーに書く
*/
class MypagesController extends AppController{
 // public $scaffold;
  public $uses = array('Bookmark','Note');
  public $components = array('Paginator');
  /*
  public $paginate = array(
          'conditions'  => array('Bookmark.user_id'=>'user_id'),
          'order' => array ('Bookmark.id'=> 'desc'),
           'limit' => '20'
   );
*/
  public function index(){
//debug( $A->user() );
    $user_id=$this->Auth->user('id');
//debug($user_id);//null
//    debug($this->Auth->user());

    if(!empty($this->params['named']['param_tag'])){
        //paman_tagが存在してるかを調べるempty
        $param_tag = $this->params['named']['param_tag'];
        $conditions = array('conditions' => array('Bookmark.tag' => $param_tag ,'Bookmark.user_id'=>$user_id));
        $bookmarks_bytag =  $this->Bookmark->find('all', $conditions);
        $this->set('bookmarks_bytag', $bookmarks_bytag);
    }
// debug($this->Bookmark);
// debug($this->Bookmark->_schema);
// debug($this->Bookmark->validationErrors);
// debug($this->Bookmark->find('all'));
    //$this->set('Bookmarks', $this->Bookmark->find('all'));
    //TODO:jQuery DataTables

  //  debug($this->paginate);
    $this->paginate=array('conditions' => array('Bookmark.user_id'=>$user_id),
         'order' => array ('Bookmark.id'=> 'desc'),
 
      );
    $this->Paginator->settings =$this->paginate;   // findAll() に似ていますが、ページ制御された結果を返します。
   // debug($this->paginate);
    $this->set('Bookmarks', $this->Paginator->paginate('Bookmark'));



    $conditons_tags  = array(
                            'fields' => array('Bookmark.tag'),
                            'group' =>array('Bookmark.tag'));
    $tags = $this->Bookmark->find('all', $conditons_tags);
    $this->set('tags', $tags);

    //Noteももってこよう
    $this->set('Notes', $this->Note->find('all'),array('order' => array('creaeted' => 'Asc')));

   // debug($this->Bookmark->find('all'));
   // debug($this->Note->find('all'),array('order' => array('creaeted' => 'Asc')));


  }

  public function bookmarks_bytag(){
        //debug($this->request->is('get'));
        //debug($this->request);
        // debug($this->params['named']['param_tag']);
        $param_tag = $this->params['named']['param_tag'];
        $conditions = array('conditions' => array('Bookmark.tag' => $param_tag));
        $bookmarks_bytag =  $this->Bookmark->find('all', $conditions);
        $this->set('bookmarks_bytag', $bookmarks_bytag);
        return $this->redirect(
            array('controller' => 'Mypages', 'action' => 'index')
       );
  }

}
