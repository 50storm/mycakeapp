<?php
/*
Bookmarkの登録、更新、削除

*/

class BookmarksController extends AppController{
 // public $scaffold;
  public $uses = array('Bookmark');
  public $helpers = array( 'Js');

  public function view($id = null) {
        $this->Bookmark->id = $id;
        if (!$this->Bookmark->exists()) {
            throw new NotFoundException(__('Invalid Bookmark'));
        }else{
           $this->set('Bookmark', $this->Bookmark->read());
        }
        
  }

  public function delete($id){
    if ($this->request->is('post') || $this->request->is('put')) {
      if($this->Bookmark->delete($id)){
         $this->Flash->success(__('ブックマークを削除しました。'));
               
            return $this->redirect(
                              array('controller' => 'Mypages', 'action' => 'index')
             );
      }
    } else{
           return $this->redirect(
                              array('controller' => 'Mypages', 'action' => 'index')
             );
     
    }
     
  }
  public function edit($id = null) {
    $user_id=$this->Auth->user('id');
    // debug($user_id);
    // debug($this->request->data);
         $this->Bookmark->id = $id;
        if (!$this->Bookmark->exists()) {
            throw new NotFoundException(__('Invalid Bookmark'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
    // debug($this->request->data);
            $this->request->data['Bookmark']['user_id'] = $user_id;
            if ($this->Bookmark->save($this->request->data)) {
                $this->Flash->success(__('ブックマークを登録しました。'));
                 return $this->redirect(
                    array('controller' => 'Mypages', 'action' => 'index')
                  );
            }
            $this->Flash->error(
                __('The Bookmark could not be saved. Please, try again.')
            );
        } else if($this->request->is('get')){
          //画面に値を表示
           $this->request->data = $this->Bookmark->read();
           // unset($this->request->data['User']['password']);
        }

  }
  public function add_ajax(){
   debug($this->request->is('post'));
    // if($this->request->is('ajax')){
       
    // }else{
    //    return $this->redirect(
    //                           array('controller' => 'Bookmarks', 'action' => 'add_ajax')
    //                           );
    
    // }
    // // save OK
  //  if ($this->Bookmark->save($this->data)) {
         //   $this->render( '/Elements/Ajaxs/ajaxupdated','ajax');
        // save NG
  //  } else {
          //  $this->set('valerror', $this->Bookmark->validationErrors);
          //  $this->render( '/Elements/Ajaxs/ajaxupdated','ajax');
  //  }

  }
   public function add() {
// debug($this->request);
       $user_id=$this->Auth->user('id');
  // debug($user_id);
        if ($this->request->is('post')) {
          // debug($this->request->data);
            $this->Bookmark->create();
            /*
Vこのメソッドはデータを保存するためにモデルの状態をリセットします。 実際にはデータベースにデータは保存されませんが、 Model::$id フィールドが クリアされ、データベースのフィールドのデフォルト値を元に Model::$data の値を セットします。データベースフィールドのデフォルト値が存在しない場合、 Model::$data には空の配列がセットされます。
            */
          
            //tagが空っぽだったら、タグなしで登録
            if(empty($this->request->data['Bookmark']['tag'])){
                $this->request->data['Bookmark']['tag'] = "タグなし";
            }
            if(empty($this->request->data['Bookmark']['title'])){
                $this->request->data['Bookmark']['title'] = "";
            }
             // debug($this->request->data);
            
             $this->request->data['Bookmark']['user_id'] = $user_id;

            if ($this->Bookmark->save($this->request->data)) {
                $this->Flash->success(__('ブックマークを登録しました。'));
                return $this->redirect(
                              array('controller' => 'Mypages', 'action' => 'index')
                              );
            }else{
                $this->Flash->error(
                    __('ブックマークが登録できませんでした。も一度トライしてください。')
                );


            }
      }
    }
}
