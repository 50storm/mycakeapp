<?php
class NotesController extends AppController{
  public $scaffold;
  public $uses = array('Note');
  
  public function index(){
    //$condition = array('condition' => array('OR' => , ) );
    
    //$opt = array('conditions' => array('OR'=>array(
    //                                       array('id' => '1' , 'title'=>'タイトル'),
    //                                       array('id' => '2'))
    //                                             )
    //                                 );
    /*
      SELECT `Post`.`id`, `Post`.`title`, `Post`.`body`, `Post`.`created`, `Post`.`modified` FROM `test_db`.`posts` AS   `Post` WHERE ((((`id` = 1) AND (`title` = 'タイトル'))) OR (`id` = 2))
    */
    //$ret = $this->Note->find('all',$opt);
    $ret = $this->Note->find('all');
    //debug($ret);
    $this->set('Notes', $ret);
    
    //$this->set('Notes', $this->Note->find('all'));
    //debug($this->Post->find('all'));
    //$this->Render("index");
    //   return $this->redirect(
    //        array('controller' => 'Notes', 'action' => 'index')
    //   );

  }

  public function view($id = null){

       $this->Note->id = $id;
        if (!$this->Note->exists()) {
            throw new NotFoundException(__('Invalid Note'));
        }
 
        $conditons = array('conditons' => array('id' => $id ));
    $ret = $this->Note->find('first', $conditons);
    //debug($ret);
    $this->set('Note', $ret);

  }

  public function edit($id = null) {
        //検索キー

        $this->Note->id = $id;
        if (!$this->Note->exists()) {
            throw new NotFoundException(__('Invalid Note'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            
            $this->request->data['Note']['user_id'] =$this->Auth->user('id');
            if ($this->Note->save($this->request->data)) {
                $this->Flash->success(__('ノートを編集しました。'));
                return $this->redirect(array('controller'=>'Mypages','action' => 'index'));
            }
            $this->Flash->error(
                __('The Note could not be saved. Please, try again.')
            );
        } else if($this->request->is('get')){
            $this->request->data = $this->Note->read();
           // unset($this->request->data['User']['password']);
        }

  }
   public function add() {
//debug($this->request);
        if ($this->request->is('post')) {
            $this->Note->create();
            /*
Vこのメソッドはデータを保存するためにモデルの状態をリセットします。 実際にはデータベースにデータは保存されませんが、 Model::$id フィールドが クリアされ、データベースのフィールドのデフォルト値を元に Model::$data の値を セットします。データベースフィールドのデフォルト値が存在しない場合、 Model::$data には空の配列がセットされます。
            */
// debug(this->Auth->user('id'));
            
             $this->request->data['Note']['user_id'] =$this->Auth->user('id');
            
            if ($this->Note->save($this->request->data)) {
                $this->Flash->success(__('The Note has been saved'));
                return $this->redirect(array('action' => 'index'));



            }else{
                $this->Flash->error(
                    __('The Note could not be saved. Please, try again.')
                );


            }
  

      }
    }
}
