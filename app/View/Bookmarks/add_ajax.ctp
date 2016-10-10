<?php
// jQuery
echo $this->Html->script('jquery');
// Jsヘルパーが生成するJSを出力させる
echo $this->Js->writeBuffer( array( 'inline' => 'true'));
?>
<div class="users form">
<?php echo $this->Form->create('Bookmark'); ?>
    <fieldset>
        <legend><?php echo __('Add Ajax Bookmark'); ?></legend>
        <?php 
        echo $this->Form->input('url');
        echo $this->Form->input('title');
        echo $this->Form->input('tag');


        echo $this->Js->submit( 'Update', array(
    'before'  => $this->Js->get( '#sending-js-submit')->effect( 'fadeIn'),  // => beforeSend (Local Event)
    'success' => $this->Js->get( '#sending-js-submit')->effect( 'fadeOut'), // => success (Local Event)
//  'error' =>                       // => error (Local Event)
//  'complete' =>                    // => complete (Local Event)
    'url' => 'Bookmarks/add_ajax',           // Ajax処理で呼び出すURL(controller/action)
    'update' => '#result-js-submit', // ajax更新の結果を出力する要素
)); 
        ?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<div id="sending-js-submit">updaing...</div>
<div id="result-js-submit"></div>