<?php
// echo $this->My->sysName();
?>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('ログイン'); ?></legend>
        <?php 
        echo $this->Form->input('User.username', array('label' => 'ユーザー名またはメールアドレス'));
        echo $this->Form->input('User.password', array('label' => 'パスワード'));
        
        /*
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));
        */
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
<?php 
echo $this->Html->link( __('*パスワード忘れた'), array('controller' => 'Users', 'action' => 'reset')); 
?>
<br/>

<?php
echo $this->Html->link( __('test'), array('controller' => 'Users', 'action' => 'test')); 
?>
</div>
