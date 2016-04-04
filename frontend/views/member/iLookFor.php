<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

use kartik\select2\Select2;

include('../views/site/form/_list.php');

for($i = date('Y')-18; $i > date('Y') - 80; $i--){
  $year[$i] = $i;
}
for($i = 1; $i <= 12; $i++){
  $month[$i] = $i;
}
for($i = 1; $i < 32; $i++){
  $day[$i] = $i;
}

?>
<?php $form = ActiveForm::begin();?>
<div class="container" style="width:100%; background-color: #e8e8e8; min-height: 150px; font-size: 12px; text-align: left; padding: 0;">
    <div class="container" style="width:100%">

		<div class="row" style="margin-bottom: 10px;">
		    <div class="col-xs-12 greenTitle">Antroji pusė tūrėtų būti</div>
		    <div class="col-xs-12 greenHr"></div>
		</div>

		<div class="row">
			<div class="col-xs-6">

		        <div class="row">
		          	<div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Gimtoji šalis</div>
		          	<div class="col-xs-8 col-sm-8 vcenter top"><?= $form->field($model, 'gimtine')->widget(Select2::classname(), [
		                                                                                          'data' => array_merge($gimtoji_salis),
		                                                                                          'language' => 'en',
		                                                                                          'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
		                                                                                          'pluginEvents' => [
		                                                                                            'select2-selected' => "function(e) { tautybe(e); }",
		                                                                                          ],
		                                                                                        ])->label(false);?> 
		          	</div>
		        </div>

		        <div class="row">
		          <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Gimtoji vieta</div>
		            <div class="col-xs-8 col-sm-8 vcenter top">
			            <div id="tautybes" style="display: none"><?= $form->field($model, 'tautybe')->widget(Select2::classname(), [
			                                                                    'data' => array_merge($gimtine),
			                                                                    'language' => 'en',
			                                                                    'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
			                                                                    'pluginEvents' => [
			                                                                      'select2-selected' => "function(e) { kitas(e, 'tautybes');  naujas(e, 'tautybe');}",
			                                                                    ],
			                                                                  ])->label(false);?></div>
			            <div id="tautybes2">
			              <?= $form->field($model, 'tautybe2')->textInput(['placeholder' => 'Praleisti jei nesvarbu'])->label(false); ?>
			            </div>
		            </div>
		        </div>

		        <div class="row">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Religija</div>
		            <div class="col-xs-8 col-sm-8 vcenter top">
			            <div id="religijos"><?= $form->field($model, 'religija')->widget(Select2::classname(), [
			                                                                                          'data' => array_merge($religija),
			                                                                                          'language' => 'en',
			                                                                                          'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
			                                                                                          'pluginEvents' => [
			                                                                                              "select2-open" => "function() { search_off(); }",
			                                                                                              "select2-close" => "function() { search_on(); }",
			                                                                                              'select2-selected' => "function(e) { kitas(e, 'religijos'); naujas(e, 'religija'); }",
			                                                                                            ],
			                                                                                        ])->label(false);?> </div>
			            <div id="religijos2" style="display: none">
			                <?= $form->field($model, 'religija2')->textInput(['placeholder' => 'Įrašykite gimtąją vietovę'])->label(false); ?><div class="xas glyphicon glyphicon-remove" id="tautoff" parent="religijos" style="right: 20px; top: 10px;"></div>
			            </div>
		            </div>
		        </div>

		        <div class="row">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Statusas</div>
		            <div class="col-xs-8 col-sm-8 vcenter top"><?= $form->field($model, 'statusas')->widget(Select2::classname(), [
		                                                                                            'data' => array_merge($statusas),
		                                                                                            'language' => 'en',
		                                                                                            'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
		                                                                                            'pluginEvents' => [
		                                                                                              "select2-open" => "function() { search_off(); }",
		                                                                                              "select2-close" => "function() { search_on(); }"
		                                                                                            ],
		                                                                                          ])->label(false);?> 
		            </div>
		        </div>

		        <div class="row">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Gyvenamoji vieta</div>
		            <div class="col-xs-8 col-sm-8 vcenter top"><?= $form->field($model, 'miestas')->widget(Select2::classname(), [
		                                                                                            'data' => array_merge($list),
		                                                                                            'language' => 'en',
		                                                                                            'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
		                                                                                            'pluginEvents' => [
			                                                                                            'select2-selected' => "function(e) { miestas(e); }",
			                                                                                        ],
		                                                                                          ])->label(false);?> 
		            </div>
		        </div>

		        <div class="row rajonas">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Gyvenamasis rajonas</div>
		            <div class="col-xs-8 col-sm-8 vcenter top"><?= $form->field($model, 'grajonas')->widget(Select2::classname(), [
		                                                                                            'data' => array_merge($rajonai),
		                                                                                            'language' => 'en',
		                                                                                            'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
		                                                                                          ])->label(false);?> 
		            </div>
		        </div>
	      	</div>

	        <div class="col-xs-6">

		        <div class="row">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Išsilavinimas</div>
		            <div class="col-xs-8 col-sm-8 vcenter top" style="position: relative; top: 1px;"><?= $form->field($model, 'issilavinimas')->widget(Select2::classname(), [
		                                                                                          'data' => array_merge($issilavinimas),
		                                                                                          'language' => 'en',
		                                                                                          'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
		                                                                                          'pluginEvents' => [
		                                                                                              "select2-open" => "function() { search_off(); }",
		                                                                                              "select2-close" => "function() { search_on(); }"
		                                                                                          ],
		                                                                                        ])->label(false);?> 
		            </div>
		        </div>

		        <div class="row">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Darbo sritys</div>
		            <div class="col-xs-8 col-sm-8 vcenter top">
			            <div id="pareigoss"><?= $form->field($model, 'pareigos')->widget(Select2::classname(), [
			                                                                                          'data' => array_merge($pareigos),
			                                                                                          'language' => 'en',
			                                                                                          'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
			                                                                                          'pluginEvents' => [
			                                                                                            'select2-selected' => "function(e) { kitas(e, 'pareigoss'); naujas(e, 'pareigos'); }",
			                                                                                          ],
			                                                                                        ])->label(false);?></div>
			            <div id="pareigoss2" style="display: none">
			              <?= $form->field($model, 'pareigos2')->textInput()->label(false); ?><div class="xas glyphicon glyphicon-remove" id="tautoff" parent="pareigoss" style="right: 20px; top: 10px;"></div>
			            </div>
		            </div>
		        </div>

		        <div class="row">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Uždarbis</div>
		            <div class="col-xs-8 col-sm-8 vcenter top"><?= $form->field($model, 'uzdarbis')->widget(Select2::classname(), [
		                                                                                          'data' => array_merge($uzdarbis),
		                                                                                          'language' => 'en',
		                                                                                          'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
		                                                                                          'pluginEvents' => [
		                                                                                              "select2-open" => "function() { search_off(); }",
		                                                                                              "select2-close" => "function() { search_on(); }"
		                                                                                          ],
		                                                                                        ])->label(false);?> 
		            </div>
		        </div>

		        <div class="row">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Seksualinė orentacija</div>
		            <div class="col-xs-8 col-sm-8 vcenter top"><?= $form->field($model, 'orentacija')->widget(Select2::classname(), [
		                                                                                          'data' => array_merge($orentacija),
		                                                                                          'language' => 'en',
		                                                                                          'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
		                                                                                          'pluginEvents' => [
		                                                                                              "select2-open" => "function() { search_off(); }",
		                                                                                              "select2-close" => "function() { search_on(); }"
		                                                                                          ],
		                                                                                        ])->label(false);?> 
		            </div>
		        </div>

		        <div class="row">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Tikslas šiame portale</div>
		            <div class="col-xs-8 col-sm-8 vcenter top"><?= $form->field($model, 'tikslas')->widget(Select2::classname(), [
		                                                                                        'data' => array_merge($tikslas),
		                                                                                        'language' => 'en',
		                                                                                        'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
		                                                                                        'pluginEvents' => [
		                                                                                            "select2-open" => "function() { search_off(); }",
		                                                                                            "select2-close" => "function() { search_on(); }"
		                                                                                        ],
		                                                                                      ])->label(false);?> 
		            </div>
				</div>

				<div class="row rajonas">
		            <div class="col-xs-4 col-sm-4 vcenter top" style="padding-right: 0px;">Darbovietės rajonas</div>
		            <div class="col-xs-8 col-sm-8 vcenter top"><?= $form->field($model, 'drajonas')->widget(Select2::classname(), [
		                                                                                            'data' => array_merge($rajonai),
		                                                                                            'language' => 'en',
		                                                                                            'options' => ['placeholder' => 'Praleisti jei nesvarbu'],
		                                                                                          ])->label(false);?> 
		            </div>
		        </div>
			</div>


		</div>


		<div class="row" style="margin-bottom: 10px;">
	   	 	<div class="col-xs-12 greenTitle">Antroji pusė tūrėtų atrodyti</div>
		    <div class="col-xs-12 greenHr"></div>
		</div>

		<div class="row">
			<div class="col-xs-6">

				<div class="row">
					<div class="col-xs-4 vcenter top2">Kūno sudėjimas</div>
					<div class="col-xs-8 vcenter top2"><?= $form->field($model, 'sudejimas')->widget(Select2::classname(), [
					                                                                                'data' => array_merge($sudejimas),
					                                                                                'language' => 'en',
					                                                                                'options' => ['placeholder' => 'Pasirinkite savo sudejimą ...'],
					                                                                                'pluginEvents' => [
					                                                                                    "select2-open" => "function() { search_off(); }",
					                                                                                    "select2-close" => "function() { search_on(); }"
					                                                                                ],
					                                                                              ])->label(false);?> 
					</div>
				</div> 

				<div class="row">
					<div class="col-xs-4 vcenter top2">Plaukų spalva</div>
					<div class="col-xs-8 vcenter top2">
						<div id="pspalva"><?= $form->field($model, 'plaukai')->widget(Select2::classname(), [
						                                                                                'data' => array_merge($plaukai),
						                                                                                'language' => 'en',
						                                                                                'options' => ['placeholder' => 'Pasirinkite savo plaukų spalvą ...'],
						                                                                                'pluginEvents' => [
						                                                                                    "select2-open" => "function() { search_off(); }",
						                                                                                    "select2-close" => "function() { search_on(); }",
						                                                                                    'select2-selected' => "function(e) { kitas(e, 'pspalva'); naujas(e, 'plaukai');}",
						                                                                                ],
						                                                                              ])->label(false);?></div>
						<div id="pspalva2" style="display: none;">
						  	<?= $form->field($model, 'plaukai2')->textInput(['placeholder' => 'Įrašykite plaukų spalvą'])->label(false); ?><div class="xas glyphicon glyphicon-remove" id="tautoff" parent="pspalva" style="right: 20px; top: 10px;"></div>
						</div>
					</div>
				</div> 

			</div>


			<div class="col-xs-6">

				<div class="row">
					<div class="col-xs-4 vcenter top2">Akių spalva</div>
					<div class="col-xs-8 vcenter top2">
						<div id="aspalva"><?= $form->field($model, 'akys')->widget(Select2::classname(), [
						                                                                                'data' => array_merge($akys),
						                                                                                'language' => 'en',
						                                                                                'options' => ['placeholder' => 'Pasirinkite savo akių spalvą ...'],
						                                                                                'pluginEvents' => [
						                                                                                    "select2-open" => "function() { search_off(); }",
						                                                                                    "select2-close" => "function() { search_on(); }",
						                                                                                    'select2-selected' => "function(e) { kitas(e, 'aspalva'); naujas(e, 'akys');}",
						                                                                                ],
						                                                                              ])->label(false);?> </div>
						<div id="aspalva2" style="display: none;">
						  	<?= $form->field($model, 'akys2')->textInput(['placeholder' => 'Įrašykite akių spalvą'])->label(false); ?><div class="xas glyphicon glyphicon-remove" id="tautoff" parent="aspalva" style="right: 20px; top: 10px;"></div>
						</div>
					</div>
				</div> 

				<div class="row">
					<div class="col-xs-4 vcenter top2">Aprangos stilius</div>
					<div class="col-xs-8 vcenter top2">
						<div id="stilius"><?= $form->field($model, 'stilius')->widget(Select2::classname(), [
						                                                                                'data' => array_merge($stilius),
						                                                                                'language' => 'en',
						                                                                                'options' => ['placeholder' => 'Pasirinkite savo stilių ...'],
						                                                                                'pluginEvents' => [
						                                                                                    'select2-selected' => "function(e) { kitas(e, 'stilius'); naujas(e, 'stilius');}",
						                                                                                ],
						                                                                              ])->label(false);?></div>
						<div id="stilius2" style="display: none;">
						  	<?= $form->field($model, 'stilius2')->textInput(['placeholder' => 'Įrašykite stilių'])->label(false); ?><div class="xas glyphicon glyphicon-remove" id="tautoff" parent="stilius" style="right: 20px; top: 10px;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php if(\frontend\models\Expired::prevent()): ?>
            <div class="alert alert-warning">
                <b>Jūsų abonimento galiojimas baigėsi.</b>
                <br>
                Keisti duomenis gali tik tie nariai, kurių abonimentas yra galiojantis. 
            </div>
            <?= $this->registerJsFile('js/preventDefault');?>
        <?php else: ?>

		<div class="row">
			<div class="col-xs-12"><?= Html::submitButton('Išsaugoti', ['class' => 'btn btn-reg', 'style' => 'width: 100%; padding: 0px;', 'name' => 'ieskoti']) ?></div>
		</div>

		<?php endif; ?>

	</div>
</div>

<?= $form->field($model, 'tautybecomplete')->textInput(['placeholder' => 'Įrašykite stilių', 'style' => 'display: none;'])->label(false); ?>
<?= $form->field($model, 'religijacomplete')->textInput(['placeholder' => 'Įrašykite stilių', 'style' => 'display: none;'])->label(false); ?>
<?= $form->field($model, 'pareigoscomplete')->textInput(['placeholder' => 'Įrašykite stilių', 'style' => 'display: none;'])->label(false); ?>
<?= $form->field($model, 'plaukaicomplete')->textInput(['placeholder' => 'Įrašykite stilių', 'style' => 'display: none;'])->label(false); ?>
<?= $form->field($model, 'akyscomplete')->textInput(['placeholder' => 'Įrašykite stilių', 'style' => 'display: none;'])->label(false); ?>
<?= $form->field($model, 'stiliuscomplete')->textInput(['placeholder' => 'Įrašykite stilių', 'style' => 'display: none;'])->label(false); ?>

<?php ActiveForm::end() ?>


<?php 



function pre_check($model, $param)
{
  if(strlen($model->$param) >= 3){
    return $model->$param;
  }
}

if($model->gimtine == 126){
  $result = "01keisti";
}else{
  $result = $model->tautybe;
}

?>

<script type="text/javascript"> 
	var tauta = '<?= $result; ?>',
	    pareiga = '<?= pre_check($model, "pareigos"); ?>',
	    religija = '<?= pre_check($model, "religija"); ?>',
	    plaukai = '<?= pre_check($model, "plaukai"); ?>',
	    akys = '<?= pre_check($model, "akys"); ?>',
	    stilius = '<?= pre_check($model, "stilius"); ?>';
</script>

<script type="text/javascript" src="/js/sSearch.js"></script>
<script type="text/javascript" src="/js/kita.js"></script>

<script type="text/javascript">
	function naujas(e, b)
	{

		if(e.choice.text == "Kita"){
			$('#usersearchdetail-'+b+'complete').val('');
		}else{
			$('#usersearchdetail-'+b+'complete').val(e.choice.id);
		}
		
	}

	function miestas(e)
	{
		if(e.val == 0){
			$('.rajonas').fadeIn();
		}else{
			$('.rajonas').fadeOut();
		}
	}


	$(function (){
		var miestas = '<?= $model->miestas; ?>';

		if(miestas == '0'){
			$('.rajonas').css({'display' : "block"});
		}
	});

	$(function(){
	if(tauta == '01keisti'){
		$('#tautybes2').css({"display" : "none"});
		$('#tautybes').css({"display" : "block"});
	}else if(tauta != null){
		$("#info-tautybe2").val(tauta);
	}
	if((pareiga !== null && pareiga !== "")){
		$('#pareigoss').css({"display" : "none"});
		$('#pareigoss2').css({"display" : "block"});
		$("#ilookfor-pareigos2").val(pareiga);
	}
	if((religija !== null && religija !== "")){
		$('#religijos').css({"display" : "none"});
		$('#religijos2').css({"display" : "block"});
		$("#ilookfor-religija2").val(religija);
	}
	if((akys !== null && akys !== "")){
		$('#aspalva').css({"display" : "none"});
		$('#aspalva2').css({"display" : "block"});
		$("#ilookfor-akys2").val(akys);
	}
	if((plaukai !== null && plaukai !== "")){
		$('#pspalva').css({"display" : "none"});
		$('#pspalva2').css({"display" : "block"});
		$("#ilookfor-plaukai2").val(plaukai);
	}
	if((stilius !== null && stilius !== "")){
		$('#stilius').css({"display" : "none"});
		$('#stilius2').css({"display" : "block"});
		$("#ilookfor-stilius2").val(stilius);
	}
});

</script>