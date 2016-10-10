<?php
// echo $this->My->sysName();
?>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('パスワードをリセットします。メールアドレスを入力してください。'); ?></legend>
        <?php 
        echo $this->Form->input('User.email', array('label' => 'メールアドレス'));
        echo $this->Form->error('User.email');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div>
<!--
<ul>
<li>
<?php echo $this->Html->link( __('Sign Up'), array('controller' => 'Users', 'action' => 'signup'));?>
</li>
<li>
<?php echo $this->Html->link( __('Login'), array('controller' => 'Users', 'action' => 'login'));?>
</li>
</ul>
-->
<?php echo $this->My->sidebar();?>
<?php echo $this->Html->link( __('*パスワード忘れた'), array('controller' => 'Users', 'action' => 'reset')); ?>
</div>
