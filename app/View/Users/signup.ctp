<?php
// echo $this->My->sysName();
?>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('ユーザー登録'); ?></legend>
        <?php 
        echo $this->Form->input('User.username', array('label' => 'ユーザー名'));
        echo $this->Form->input('User.password', array('label' => 'パスワード'));
        echo $this->Form->input('User.password2', array('type'=>'password','label' => 'パスワード確認用') );
        echo $this->Form->input('User.email');
        /*
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));
        */
    ?>
    </fieldset>
<?php echo $this->Form->end(__('サインアップ')); ?>
</div>
<div>
<ul>
<li>
<?php 
echo $this->Html->link( __('サインアップ'), array('controller' => 'Users', 'action' => 'signup'));
?>
</li>
<li>
<?php echo $this->Html->link( __('ログイン'), array('controller' => 'Users', 'action' => 'login'));?>
</li>
</ul>
</div>



