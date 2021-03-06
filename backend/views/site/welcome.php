<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1>Automatinės žinutės</h1>
            <p>Pasisveikinimo žinutė, kuri bus parašyti naujam nariui prisiregistravus ir praėjus 2 minutėms.</p>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-3">
            <h3>Dalyvauja žinučių siuntime</h3>

            <div class="alert alert-info">Atskiras žinutes, kurias pasirinks atsitiktinai atskirti simboliais || <br> <b>Pavyzdys:</b> Labas||Sveikas||Graži nuotrauka ;)||Labutis, kaip sekasi?</div>

            <?= ListView::widget( [
                'layout' => '<div style="float: left; width: 100%;">{items}</div><div class="row" style="padding-left: 15px; padding-right: 15px; text-align: right;">{pager}</div>',
                'dataProvider' => $DP['players'],
                'itemView' => '//site/includes/welcome',
            ] );
            ?>
        </div>
        <div class="col-xs-9">
            <h3>Pasirinkite narius kurie dalyvaus žinučių siuntime</h3>

            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

                <div class="row">
                    <div class="col-xs-6"><?= $form->field($model, 'username')->textInput(['placeholder' => 'Ieškoti pagal slapyvardį'])->label(false); ?></div>
                    <div class="col-xs-6"><?= Html::submitButton('Ieškoti', ['class' => 'btn btn-primary', 'value'=>'Create & Add New']) ?></div>
                </div>

            <?php ActiveForm::end() ?>

            <?= ListView::widget( [
                'layout' => '<div style="float: left; min-width: 877px; ">{items}</div><div class="row" style="padding-left: 15px; padding-right: 15px; text-align: right;">{pager}</div>',
                'dataProvider' => $DP['fakes'],
                'itemView' => '//site/includes/LWtoWelcome',
            ] );
            ?>
            <script type="text/javascript">
                $(".recentImgHolder img.cntrm").fakecrop({wrapperWidth: $('.recentImgHolder').width(),wrapperHeight: $('.recentImgHolder').width(), center: true });
                $(".recentImgHolder2 img.cntrm2").fakecrop({wrapperWidth: $('.recentImgHolder2').width(),wrapperHeight: $('.recentImgHolder2').width(), center: true });
            </script>

        </div>
    </div>
</div>

<script type="text/javascript">
    $('.submit').click(function(){
        var id = $(this).attr('u_id');
        var msg = $('#msg_'+id).val();

        $.ajax({
            type: 'POST',
            url: "?r=site/updatemsg",
            data: {id : id, msg : msg},
            success: function(data){
                console.log('success');

                $('.submit[u_id="'+id+'"]').removeClass('btn-success').addClass('btn-primary');
            },
            error: function(ts){
                console.log(ts.responseText);
                console.log(this.url);
            }
        });
    });

    $("textarea").keyup(function(){
        var id = $(this).attr('u_id');

        $('.submit[u_id="'+id+'"]').removeClass('btn-primary').addClass('btn-success');
    });
</script>


