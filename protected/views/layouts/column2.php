<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-8 last" style="float: right;">
	<div id="sidebar">
            <div class="well" style=" padding: 8px 0;" class="span-5">
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'Operations',
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'nav nav-list'),
		));
		$this->endWidget();
	?>
            </div>
	</div><!-- sidebar -->
</div>
<div class="span-20" style="float: left;">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>

<?php $this->endContent(); ?>

