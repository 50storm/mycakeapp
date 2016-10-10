<?php
/*
sha256でパスワードは保存。登録時は、AppControllerに記載
登録日:createdでsha256でハッシュを作る。
認証メールに、idと、createdのハッシュで作成したurlを踏んだらstatusのフラグを立てる


*/

//require_once的なもの
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('CakeEmail', 'Network/Email');


class UsersController extends AppController{
  //public $scaffold;
  public $uses = array('User');
  public $hasMany = array('Bookmark','Note');

  public $components = array( 'Auth','Flash');
  public $helpers = array('My');


  public function beforeFilter() {
     parent::beforeFilter();
     parent::beforeFilter();
     $this->Auth->allow('login','add','activate','signup','reset','restpassword');
  }
    
  public function login(){
     
    if($this->request->is('post')){
      $email_or_username = $this->data['User']['username'];

      //メールアドレス形式か判断
      //デリミタはスラッシュ
      //\Aは〜からはじます
      $pattern = '/\A([a-z0-9_\-\+\/\?]+)(\.[a-z0-9_\-\+\/\?]+)*'.'@([a-z0-9\-]+\.)+[a-z]{2,6}\z/i';
  
      $conditions["conditions"]="";
      $id="";
      if(preg_match($pattern, $email_or_username)){
        $id=array('email'=> $email_or_username);
      }else{     
        $id=array('username'=>$email_or_username);
      }
      $password = array('password'=>$this->__setHashCode($this->data['User']['password']));    
      $conditions["conditions"]=array_merge($id, $password);
      
      $user = $this->User->Find('first', $conditions);
      if(!empty($user)){
        if($this->Auth->login($user['User'])){
        //ログイン成功したときの処理
        //$this->Auth->redirectUrl()でリダイレクト先を取得 2.3より前なら$this->Auth->    return $this->redirect($this->Auth->redirectUrl());
        return $this->redirect($this->Auth->redirectUrl());

        }else{
          //ログイン失敗したときの処理
          $this->Flash->error( __('ログインできませんでした。'));
          // 2.7 より前なら
          // $this->Session->setFlash(__('Username or password is incorrect'));
        }
      }else{
          $this->Flash->error( __('システムに登録されていません。'));

      }

    } 
   }

     public function activate( $user_id = null, $in_hash = null) {
        // UserモデルにIDをセット
        //モデルに読み込む場合
        //$this->User->id = $user_id;
        //$this->User->read();
        //モデルに読み込む場合
      
        if(!isset($user_id) && !isset($in_hash))
        {
          throw new BadRequestException("URLが間違っています");
          $this->Flash->set( 'URLが間違っています');
          return;
          
        }
         $NewUser = $this->User->findById($user_id , array('fields'=>'created'));
         if ($this->User->exists($user_id) && 
             $in_hash == $this->__setHashCode($NewUser['User']['created'])) 
         {
             $this->User->id = $user_id;        
             $this->User->saveField( 'status', 0);
             //$msg = 'アカウントが有効になりました。';
             //$this->set('msg', $msg);
             $this->Flash->set('アカウントが有効になりました。');
         }else{
         // 本登録に無効なURL
            throw new BadRequestException("URLが間違っています");
            $this->Flash->set( 'URLが間違っています');
         
         }
         
      }

    public function signup() {
      // debug($this->request->data);

      //exit;
        if (!empty( $this->request->data)){
         
            //  保存
            if( $this->User->save( $this->request->data)){
              $id = $this->User->getLastInsertID();
              $NewUser = $this->User->findById($id,array('fields'=>'created'));

                // ユーザアクティベート(本登録)用URLの作成
                $url = 
                    DS . strtolower($this->name) .          // コントローラ
                    DS . 'activate' .                       // アクション
                    DS . $this->User->id .                  // ユーザID
                    DS . $this->__setHashCode($NewUser['User']['created']);  // ハッシュ値(Createdで作る)
                $url = Router::url( $url, true);  // ドメイン(+サブディレクトリ)を付与
                //  メール送信
                //SMTP server did not accept the password.=>gmailの設定変更
                //GMAILは安全性の低いアプリの設定をする
                $email = new CakeEmail('sakura');  
                $email->from( array( 'igarashi.jyuku@gmail.com' => 'Hiroshi Igarashi'));  // 送信元
                $email->to($this->request->data['User']['email'] );         
                $email->subject( '仮登録完了メール');                      
                $message = "仮登録が完了しました。\nURLをクリックしてアカウントを有効にしてください。\n".$url;
                $email->send($message);                             

                $this->Flash->set( '仮登録成功。メール送信しました。');
            } else {
                //  バリデーションエラーメッセージを渡す
                $this->Flash->set( '入力エラー');
            }
        }
    }


    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Flash->success(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->findById($id);
            unset($this->request->data['User']['password']);
        }
    }

    public function reset(){
      if($this->request->is('post')){
        //メールアドレスかチェック
       $conditions["conditions"]['email']=$this->data['User']['email'];
       $user = $this->User->Find('first', $conditions);
       //debug($user);
       if(!empty($user)){
            // ユーザアクティベート(本登録)用URLの作成
                $url = 
                    DS . strtolower($this->name) .          // コントローラ
                    DS . 'restpassword' .                       // アクション
                    DS . $this->User->id .                  // ユーザID
                    DS . $this->__setHashCode($user['User']['created']);  // ハッシュ値(Createdで作る)
                $url = Router::url( $url, true);  // ドメイン(+サブディレクトリ)を付与
//debug($url);
//exit;

                //  メール送信
                //SMTP server did not accept the password.=>gmailの設定変更
                //GMAILは安全性の低いアプリの設定をする
                $email = new CakeEmail('sakura');  
                $email->from( array( 'igarashi.jyuku@gmail.com' => 'Hiroshi Igarashi'));
                // debug($this->request->data['User']['email']);
                $email->to( $this->data['User']['email'] );         
                // $email->to($this->request->data['User']['email'] );         
                $email->subject( 'パスワードリセット');                      
                $message = "パスワードリセット。\nURLをクリックしてパスワードをリセットにしてください。\n".$url;
                $email->send($message);                             

                $this->Flash->set( 'パスワードリセット用のアドレスをメール送信しました。');

       }else{
           $this->Flash->set( 'メールアドレスを入力してください。');
       }
    }
  }

  public function restpassword($in_hash = null){
    debug($in_hash);
  }

/*
    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Flash->success(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Flash->error(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
*/
    //Sha256ハッシュを作る
    private function __setHashCode($val){
      $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
      return $passwordHasher->hash($val);
    }
}
