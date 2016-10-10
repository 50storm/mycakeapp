<?php
$link= $this->Html->link(__('ログインはこちら'), array('controller' => 'Users', 'action' => 'login',null)
);

?>

<div class="users form">
<?php echo $this->Html->para(null, $link); ?>

</div>
