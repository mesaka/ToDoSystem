<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {

    public $name = 'User';

    // public $belongsTo = array('Organization', 'Group');
    public $hasMany = 'Task';
    public $hasAndBelongsToMany = array(
        'Group' => array(
          'className'              => 'Group',
          'joinTable'              => 'groups_users',
          'foreignKey'             => 'user_id',
          'associationForeignKey'  => 'group_id',
        )
    );     

	public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'お名前を入力してください'
            )
        ),
        'email' => array(
            'required' => array(
                'rule' => array('email'),
                'message' => 'メールアドレスを入力してください'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'パスワードを入力してください'
            ),
            'match' => array(
                'rule' => array('confirmPassword', 'password_confirm'),
                'message' => 'パスワードが一致しません'
            ),
            'length' => array(
                'rule' => array('minLength', 4),
                'message' => '4文字以上入力してください'
            ),
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notBlank'),
                'message' => 'A id is required'
            ),
            'length' => array(
                'rule' => array('minLength', 4),
                'message' => '4文字以上入力してください'
            ),
        ),
        'validEmail' => array(
                'emailExists' => array( 'rule' => 'isUnique', 'message' => '既に登録されています'),
                'rule' => array('email', true),
                'message' => 'アドレスを入力して下さい'
        ),
    );


	// public function beforeSave($options = array()) {
	//     if (isset($this->data[$this->alias]['password'])) {
	//         $passwordHasher = new BlowfishPasswordHasher();
	//         $this->data[$this->alias]['password'] = $passwordHasher->hash(
	//             $this->data[$this->alias]['password']
	//         );
	//     }
	//     return true;
	// }

  // public function confirmPassword( $field, $password_confirm) {
  //     if ($field['password'] === $this->data[$this->name][$password_confirm]) {
  //       // パスワードハッシュ化
  //       $this->data[$this->name]['password'] = Security::hash( $plain, 'sha512', true);
  //       return true;
  //     }
  // }
  public function confirmPassword( $field, $password_confirm) {
      if ($field['password'] === $this->data[$this->name][$password_confirm]) {
        // パスワードハッシュ化
        $passwordHasher = new BlowfishPasswordHasher();
          $this->data[$this->alias]['password'] = $passwordHasher->hash(
              $this->data[$this->alias]['password']
          );
        return true;
      }
  }

  public function getActivationHash() {
      // ユーザIDの有無確認
      if (!isset($this->id)) {
          return false;
      }
      // 更新日時をハッシュ化
      return Security::hash( $this->field('modified'), 'md5', true);
  }

    public function updateLastLogin($id) {
        $this->id = $id;
        $data = array(
                'last_login' => date('Y-m-d H:i:s'),
                'modified' => false
                );
        return $this->save($data);
    }

    public function checkFirstLogin($id,$entry) {
        $this->id = $id;
        // 本登録が完了していない場合エラーを出す
        if ($entry == '0'){
            throw new MethodNotAllowedException(__('本登録が完了していません'));
        }
        
        return true;
    }
}