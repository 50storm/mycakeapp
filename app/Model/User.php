<?php
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
class User extends AppModel{
    //public $hasMany;
    public $hasMany = array('Bookmark');
    // スキーマ passowrd2はusersテーブルにはない
    // public $_schema = array(
    //     'password2' => array(
    //         'type'   => 'CARCHAR',
    //         'length' => 255,
    //     ),
    // );

    // public $virtualFields = array(
    // '       password' => 'password2'
    // );

    public $useTable='users';
 
    public $validate = array(
        'username' => array(
            'rule1' => array(
                'rule' => 'notBlank',
                'required'=>true,
                'message' => 'ユーザー名を入力してください'
            )
        ),
        'password' => array(
               'must' => array(
                    'rule' => 'notBlank',
                    'required' => true,
                    'message' => 'パスワードが入力されていません'
                    ),
                'IsPassword2Set' => array(
                    'rule' => 'IsPassword2Set',
                    'message' => 'パスワード確認用を入力してください。'
                    ), 
                'pattern' => array(
                    'rule' => '/\A(?=.*?[a-z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]{8,100}+\z/i',
                    'message' => 'パスワードは、半角英数、記号をそれぞれ一種類含む。８文字以上が必要です。'
                    ),
                'IsSamePassword' => array(
                    'rule' => 'IsSamePassword',
                    'message' => 'パスワードの入力が間違っています。'
                    )
        ),
        // 'password2' => array(
        //     'required' => array(
        //         'rule' => 'notBlank',
        //         'message' => 'パスワードが入力されていません'
        //     ),
            // 'IsSamePassword' => array(
            //     'rule' => 'IsSamePassword',
            //     'message' => 'パスワードの入力が間違っています。'
            // )
        //),
        'email' => array(

                         'must'=>array(
                                'rule' => 'notBlank',
                                'required' => true,
                                'message' => 'emailが入力されていません'
                                        ),
                         'unique'=>array(
                                'rule' => array( 'isUnique', array('email', 'username'), false),
                                'message' => 'このユーザ名とメールアドレスの組み合わせはすでに使われています。'
                                        ),
                         )
        /*
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
        */
    );

    public function IsPassword2Set(){
        $pw2=$this->data['User']['password2'];
        if(empty($pw2)){
            return false;
        }else{
            return true;

        }

    }


    public function IsSamePassword(){
    // debug($this->data['User']['password']);
    // debug($this->data['User']['password2']);
            $pw1=$this->data['User']['password'];
            $pw2=$this->data['User']['password2'];
            if(empty($pw2)){
                return false;
            }
            return ($pw1 === $pw2) ? true :false;

    }
    public function beforeSave($options = array()) {
        if (isset($this->data['User']['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha256'));
            $this->data['User']['password'] = $passwordHasher->hash(
                $this->data['User']['password']
            );
        }
        return true;
    }

    public function getActivationHash() {
        // ユーザIDの有無確認
        if (!isset($this->id)) {
            return false;
        }
        //1つのカラムなら、fieldが楽
        return Security::hash( $this->field('created'), 'sha256', true);
    }
}
