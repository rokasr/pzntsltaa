<?php
use yii\widgets\ListView;

?>
<h2>Tavo anketą žiūrėję žmonės</h2>

<div class="col-xs-4">
	<div class="frame" style="font-size: 18px;">
		<p style="padding: 15px 5px;margin: 0; display: inline-block">Šiandien</p>

		<div class="hKvadratas gSquare" style="float: right"><?= $model->viewsToday() ?></div>
	</div>
	<div class="arrow-left" style="position: absolute; right: -8px; top: 20px"></div>


	<div class="row">
		<hr>
		<div class="col-xs-12" style="text-align: center;">
			<h4>Viso peržiūrų</h4>

			<div style="display: inline-block; margin: 0 5px;">
				<div class="gSquare" style="width: 74px; height: 74px; padding-top: 18px"><?= $model->viewsWeek() ?></div>
				<p>Šią savaitę<br>&nbsp;</p>
			</div>
			<div style="display: inline-block; margin: 0 5px;">
				<div class="gSquare" style="width: 74px; height: 74px; padding-top: 18px"><?= $model->viewsMonth() ?></div>
				<p>Šį mėnesį<br>&nbsp;</p>
			</div>
			<div style="display: inline-block; margin: 0px 5px; ">
				<div class="gSquare" style="width: 74px; height: 74px; padding-top: 18px"><?= $model->viewsAll() ?></div>
				<p style="width: 74px;">Nuo anketos sukūrimo</p>
			</div>

		</div>
	</div>
</div>

<div class="col-xs-8">
	<div class="frame">
		<?php Yii::$app->params['close'] = 0; ?>

		<?= ListView::widget( [
		    'layout' => '<div class="row" style="padding-left: 15px; padding-right: 15px;">{items}</div><div class="row" style="padding-left: 15px; padding-right: 15px; text-align: right;">{pager}</div>',
		    'dataProvider' => $dataProvider,
		    'itemView' => '//member/statistika/_views',
		    'pager' =>[
		        'maxButtonCount'=>0,
		        'nextPageLabel'=>'Kitas &#9658;',
		        'nextPageCssClass' => 'removeStuff',
		        'prevPageLabel'=>'&#9668; Atgal',
		        'prevPageCssClass' => 'removeStuff',
		        'disabledPageCssClass' => 'off',
		    ]

		    ] ); 
		?>
	</div>

	<script type="text/javascript">
		$(".avatarHolder img.cntrm").fakecrop({wrapperWidth: $('.avatarHolder').width(),wrapperHeight: $('.avatarHolder').width(), center: true });
	</script>

	<br>


</div>


<script type="text/javascript">
	$('.hKvadratas').each(function(){
		var p = $(this).parent();

		$(this).css({
			'width' : p.height() + 'px',
			'height' :  p.height() + 'px',
			'padding-top' : (p.height() - 38) / 2 + "px",
		});
		console.log(p);
	});
</script>


