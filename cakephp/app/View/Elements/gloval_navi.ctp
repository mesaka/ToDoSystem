<!--navbar-inverseで黒色のナビゲーションへ-->
<nav class="navbar navbar-inverse navbar-fixed-top">
   
   <!--ウィンドウ幅に合わせて可変-->
  <div class="container-fluid">
      
    <div class="navbar-header">  
      <!--スマホ用トグルボタンの設置-->
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        
      <!--ロゴ表示の指定-->
      <a class="navbar-brand" href="/kadai/cakephp/groups/index">ロゴ</a>
    </div>
      
      <!--スマホ用の画面幅が小さいときの表示を非表示にする-->
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li><?php echo $this->Html->link('カレンダー', array('controller' => 'tasks', 'action' =>'schedule')); ?></li>
        <li><?php if (isset($userSession)) {
                        echo $this->Html->link('ログアウト', array('controller' => 'users', 'action' => 'logout'));
                      } else {
                        echo $this->Html->link('ログイン', array('controller' => 'users', 'action' => 'login'));
                      }?></li>
        <li><?php echo $this->Html->link('お問い合わせ', array('controller' => 'contacts', 'action' =>'index')); ?></li>
      </ul>
    </div>

  </div><!--/.container-fluid -->
</nav>