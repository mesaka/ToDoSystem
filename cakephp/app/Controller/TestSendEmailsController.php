<?php

class TestSendEmailsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Paginator', 'Session');
	public $uses = array('Task', 'User');

	public function index() {
		$tasks = $this->Task->find('all', array('conditions' => array('alert_switch' => 1)));

		$this->set(compact('tasks'));

		$now = date("Y-m-d G:i:s");

		foreach ($tasks as $task) {
			$id = $task['Task']['id'];
            $user_id = $task['Task']['user_id'];
            $title = $task['Task']['title'];
            $contents = $task['Task']['contents'];
			$alert_switch = $task['Task']['alert_switch'];
			$alert_time = $task['Task']['alert_time'];
			$date = $task['Task']['deadline_date'];
			$time = $task['Task']['deadline_time'];
			$target_day = $date . ' ' . $time;

            $users = $this->User->find('all', array('fields' => array('id', 'email'), 'conditions' => array('User.id' => $user_id)));
            $user_email = Hash::extract($users, '{n}.User.email');
            $subject = 'ToDoSystemからのお知らせ';
            $message_first_half = 'もうすぐ次のタスクの予定日です。';
            $message_second_half = '<br>タイトル: ' . $title . '<br>内容: '  . $contents;

			switch ($alert_time) {
                // 1ヶ月前
                case 0:
                    $result = (strtotime($target_day) - strtotime($now)) / (60 * 60 * 24);
                    $tmp_result = ceil($result);
                    var_dump($tmp_result);

                    if ($tmp_result == '30') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 1ヶ月前'.$message_second_half)) {
                            $data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                            $fields = array('alert_switch');
                            $this->Task->save($data, false, $fields);
                        }
                    }
                    break;
                // 2週間前
                case 1:
                    $result = (strtotime($target_day) - strtotime($now)) / (60 * 60 * 24);
                    $tmp_result = ceil($result);
                    var_dump($tmp_result);

                    if ($tmp_result == '14') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 2週間後'.$message_second_half)) {
                            $data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                            $fields = array('alert_switch');
                            $this->Task->save($data, false, $fields);
                        }
                    }
                    break;
				// 1週間前
				case 2:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60 * 24);
                    $tmp_result = ceil($result);
                    var_dump($tmp_result);

					if ($tmp_result == '7') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 1週間後'.$message_second_half)) {
                        	$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        	$fields = array('alert_switch');
                        	$this->Task->save($data, false, $fields);
                        }
                    }
					break;

				// 3日前
				case 3:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60 * 24);
                    $tmp_result = ceil($result);

					if ($tmp_result == '3') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 3日後'.$message_second_half)) {
                        	$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        	$fields = array('alert_switch');
                        	$this->Task->save($data, false, $fields);
                        }
                    }
					break;

				// 1日前
				case 4:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60 * 24);
                    $tmp_result = ceil($result);

                    if ($tmp_result == '1') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 明日'.$message_second_half)) {
                        	$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        	$fields = array('alert_switch');
                        	$this->Task->save($data, false, $fields);
                        }
                    }
					break;

				// 12時間前
				case 5:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60);
                    $tmp_result = ceil($result);

                    if ($tmp_result == '12') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 12時間後'.$message_second_half)) {
                        	$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        	$fields = array('alert_switch');
                        	$this->Task->save($data, false, $fields);
                        }
                    }
					break;

				// 6時間前
				case 6:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60);
                    $tmp_result = ceil($result);

                    if ($tmp_result == '6') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 6時間後'.$message_second_half)) {
                        	$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        	$fields = array('alert_switch');
                        	$this->Task->save($data, false, $fields);
                        }
                    }
					break;

				// 3時間前
				case 7:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60);
                    $tmp_result = ceil($result);
                    echo $tmp_result .'時間前です';

                    if ($tmp_result == '3') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 3時間後'.$message_second_half)) {
                        	$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        	$fields = array('alert_switch');
                        	$this->Task->save($data, false, $fields);
                        }
                    }
					break;

				// 1時間前
				case 8:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60);
                    $tmp_result = ceil($result);
                    echo $tmp_result .'時間前です';

                    if ($tmp_result == '1') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 1時間後'.$message_second_half)) {
                        	$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        	$fields = array('alert_switch');
                        	$this->Task->save($data, false, $fields);
                        }
                    }
					break;

				// 30分前
				case 9:
					$result = (strtotime($target_day) - strtotime($now)) / (60);
                    $tmp_result = ceil($result);
                    echo $tmp_result .'分前です';

                    if ($tmp_result == '30') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send($message_first_half.'<br>期限: 30分後'.$message_second_half)) {
                        	$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        	$fields = array('alert_switch');
                        	$this->Task->save($data, false, $fields);
                        }
                    }
					break;

				// 締め切り時間
				case 10:
					$result = (strtotime($target_day) - strtotime($now)) / (60);
                    $tmp_result = ceil($result);

                    if ($tmp_result == '0') {
                        $email = new CakeEmail('mail');
                        $email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        $email->to($user_email);
                        $email->subject($subject);

                        if ($email->send('次のタスクの予定時間です。'.$message_second_half)) {
                        	$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        	$fields = array('alert_switch');
                        	$this->Task->save($data, false, $fields);
                        }
                    }
					break;

				default:
					echo '不正な値です';

			}

		}
	}

}