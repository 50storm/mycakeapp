<?php
class PostsController extends AppController{
  public $scaffold;
  public $uses = array('Post');
  
  public function index(){
    //$condition = array('condition' => array('OR' => , ) );
    
    $opt = array('conditions' => array('OR'=>array(
                                            array('id' => '1' , 'title'=>'タイトル'),
                                            array('id' => '2'))
                                                  )
                                      );
    /*
      SELECT `Post`.`id`, `Post`.`title`, `Post`.`body`, `Post`.`created`, `Post`.`modified` FROM `test_db`.`posts` AS   `Post` WHERE ((((`id` = 1) AND (`title` = 'タイトル'))) OR (`id` = 2))
    */
    $ret = $this->Post->find('all',$opt);
    debug($ret);
    $this->set('Posts', $ret);
    
    //$this->set('Posts', $this->Post->find('all'));
    //debug($this->Post->find('all'));
    $this->Render("index");

  }
   public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('The Post has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The Post could not be saved. Please, try again.')
            );
  

      }
    }
}
