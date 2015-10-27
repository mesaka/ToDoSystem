<?php

class SendMailShell extends AppShell {
	
	public $uses = array("Task");
		

	public function alert() {
		$tasks = $this->Task->find('all', array('fields' => array('id', 'deadline_date', 'deadline_time', 'alert_switch', 'alert_time'), 'conditions' => array('alert_switch' => 1)));
		
		$now = date("Y-m-d G:i:s");
		
		foreach ($tasks as $task) {
			$id = $task['Task']['id'];
			$alert_switch = $task['Task']['alert_switch'];
			$alert_time = $task['Task']['alert_time'];
			$date = $task['Task']['deadline_date'];
			$time = $task['Task']['deadline_time'];

			$target_day = $date . ' ' . $time;

			switch ($alert_time) {
				# 1週間前
				case 0:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60 * 24);
                    			$tmp_result = ceil($result);

					if ($tmp_result == '7') {
                        			$email = new CakeEmail('mail');
                        			$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        			$email->to('kidsdream226@gmail.com');
                        			$email->subject('メール自動送信テスト');

                        			if ($email->send('1週間前です')) {
                        				$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        				$fields = array('alert_switch');
                        				$this->Task->save($data, false, $fields);
                        			}
                    			}
					break;

				# 3日前
				case 1:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60 * 24);
                    			$tmp_result = ceil($result);

					if ($tmp_result == '3') {
                        			$email = new CakeEmail('mail');
						$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                                                $email->to('kidsdream226@gmail.com');
                        			$email->subject('メール自動送信テスト');

                        			if ($email->send('3日前です')) {
                        			$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        			$fields = array('alert_switch');
                        			$this->Task->save($data, false, $fields);
                        			}
                    			}
					break;

				# 1日前
				case 2:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60 * 24);
                    			$tmp_result = ceil($result);
					
					if ($tmp_result == '1') {
                        			$email = new CakeEmail('mail');
                        			$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        			$email->to('kidsdream226@gmail.com');
                        			$email->subject('メール自動送信テスト');

                        			if ($email->send('1日前です')) {
                        				$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        				$fields = array('alert_switch');
                        				$this->Task->save($data, false, $fields);
                        			}
                    			}
					break;

				# 12時間前
				case 3:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60);
                    			$tmp_result = ceil($result);

					if ($tmp_result == '12') {
                        			$email = new CakeEmail('mail');
                        			$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        			$email->to('kidsdream226@gmail.com');
                        			$email->subject('メール自動送信テスト');

                        			if ($email->send('12時間前です')) {
                        				$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        				$fields = array('alert_switch');
                        				$this->Task->save($data, false, $fields);
                        			}
                    			}
					break;

				# 6時間前
				case 4:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60);
                    			$tmp_result = ceil($result);

					if ($tmp_result == '6') {
                        			$email = new CakeEmail('mail');
                        			$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        			$email->to('kidsdream226@gmail.com');
                        			$email->subject('メール自動送信テスト');

                        			if ($email->send('6時間前です')) {
                        				$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        				$fields = array('alert_switch');
                        				$this->Task->save($data, false, $fields);
                        			}
                    			}
					break;

				# 3時間前
				case 5:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60);
                    			$tmp_result = ceil($result);

					if ($tmp_result == '3') {
                        			$email = new CakeEmail('mail');
                        			$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        			$email->to('kidsdream226@gmail.com');
                        			$email->subject('メール自動送信テスト');

                        			if ($email->send('3時間前です')) {
                        				$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        				$fields = array('alert_switch');
                        				$this->Task->save($data, false, $fields);
                        			}
                    			}
					break;

				# 1時間前
				case 6:
					$result = (strtotime($target_day) - strtotime($now)) / (60 * 60);
                    			$tmp_result = ceil($result);
					
					if ($tmp_result == '1') {
                        			$email = new CakeEmail('mail');
                        			$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        			$email->to('kidsdream226@gmail.com');
                        			$email->subject('メール自動送信テスト');

                        			if ($email->send('1時間前です')) {
                        				$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        				$fields = array('alert_switch');
                        				$this->Task->save($data, false, $fields);
                        			}
                    			}
					break;

				# 30分前
				case 7:
					$result = (strtotime($target_day) - strtotime($now)) / (60);
                    			$tmp_result = ceil($result);

					if ($tmp_result == '30') {
                        			$email = new CakeEmail('mail');
                        			$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        			$email->to('kidsdream226@gmail.com');
                        			$email->subject('メール自動送信テスト');

                        			if ($email->send('30分前です')) {
                        				$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        				$fields = array('alert_switch');
                        				$this->Task->save($data, false, $fields);
                        			}
                    			}
					break;

				# 締め切り時間
				case 8:
					$result = (strtotime($target_day) - strtotime($now)) / (60);
                    			$tmp_result = ceil($result);

					if ($tmp_result == '0') {
                        			$email = new CakeEmail('mail');
                        			$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より'));
                        			$email->to('kidsdream226@gmail.com');
                        			$email->subject('メール自動送信テスト');

                        			if ($email->send('締め切り時間です')) {
                        				$data = array('Task' => array('id' => $id, 'alert_switch' => 0));
                        				$fields = array('alert_switch');
                        				$this->Task->save($data, false, $fields);
                        			}
                    			}
					break;

				default:
					$this->out('送るメールはないか、不正なデータです');

			}
			
		}
	}


	public function main(){
		$email = new CakeEmail('mail');
		$email->from( array('yagishita@nunatoi.jp' => 'ぬなとゐシステム合同会社より')); 
		$email->to('kidsdream226@gmail.com');
		$email->subject('メール自動送信テスト by Console');
		$email->send('成功！！！！');
  	}
}
