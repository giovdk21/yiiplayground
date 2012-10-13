<div class="right_menu">
	<div class="title">Examples
		<?php echo CHtml::ajaxLink('&gt;&gt;',
			Yii::app()->createUrl('/site/toggleRightMenu'),
			false,
			array('id'=>'toggle_right_menu')
		); ?>
	</div>
	<?php if(!empty($links)): ?>
	<ul>
		<?php foreach($links as $item): ?>
		<li<?php echo (!empty($item['class']) ? ' class="'.$item['class'].'"' : ''); ?>>
		<a href="<?php echo $item['href']; ?>" title="<?php echo $item['label']; ?>">
		<?php echo $item['label']; ?></a></li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</div>