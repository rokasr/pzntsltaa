<?php

use yii\helpers\Url;
use frontend\models\getPhotoList;
use frontend\models\Photos;
use yii\helpers\BaseFileHelper;


$id = isset($_GET['id']) ? $_GET['id'] : Yii::$app->user->id;

?>

<?php foreach ($photos as $photo): ?>
    <?php
    $photo = BaseFileHelper::normalizePath($photo, '/');
    $parts = explode('/', $photo);
    $name = $parts[count($parts) - 1];

    $name = getPhotoList::nameExtraction($name);

    $fullName = 'BFl' . $name['pure'] . 'EFl' . $name['ownerId'] . '.' . $name['ext'];

    $dir = '';
    for ($i = 0; $i < count($parts) - 1; $i++) {
        $dir .= $parts[$i] . '/';
    }

    $url = Url::to(['member/myfoto', 'ft' => 'showFoto', 'n' => $fullName, 'd' => '/' . $dir, 'id' => $id]);

    $model = Photos::getPhoto($name['pure'], $id);

    if ($name['pirmostrys'] == 'BTh') {
        ?>

        <div class="col-xs-4 notEmptyPhoto kvadratas" id="<?= $name['pure'] ?>">

            <a href="<?= $url ?>">
                <div>
                    <img src="<?= '/' . $photo; ?><?php echo '?un=' . time(); ?>" class="cntrm" width="221px">
                </div>
            </a>

            <div class="morePhoto" data-trigger="<?= $name['pure'] ?>">
                <a href="<?= $url ?>">
                    <div class="row">
                        <div class="col-xs-6"></div>
                        <div class="col-xs-6"></div>
                    </div>
                </a>

                <div class="row">
                    <div class="col-xs-6 padidinti" data-trigger="<?= $name['pure'] ?>">
                        <span class="glyphicon glyphicon-resize-full"></span>
                    </div>
                    <?php if ($model->profile): ?>
                    <a style="opacity: 0.3;" onclick="alert('Profilio nuotraukos užrakinti negalima');">
                        <?php else: ?>
                        <a href="<?= Url::to(['member/lock', 'pureName' => $name['pure'], 'id' => $id]); ?>"
                           onclick="return confirm('<?= ($model->friendsOnly) ? 'Ar tikrai norite padaryti šią nuotrauką matoma visiems?' : 'Ar tikrai norite padaryti šią nuotrauką matoma tik draugams?'; ?>');">
                            <?php endif;
                            ?>
                            <div class="col-xs-6" style=""><span
                                    class="glyphicon glyphicon-<?= ($model->friendsOnly) ? 'lock' : 'ok'; ?>"></span>
                                <div class="labelPhoto"><?= ($model->friendsOnly) ? 'Tik draugams' : 'Matoma visiems'; ?></div>
                            </div>
                        </a>
                </div>
            </div>

            <div class="menuPhoto" style="display: none;" data-trigger="<?= $name['pure'] ?>">
                <div class="row">
                    <a href="<?= Url::to(['member/changeppic', 'n' => $fullName, 'd' => $dir]); ?>"
                       onclick="return confirm('Ar tikrai norite naudoti šią nuotrauką kaip profilio nuotrauką?');">
                        <div class="col-xs-6" style="<?= ($model->profile) ? 'color: #95c501;' : ''; ?>"><span
                                class="glyphicon glyphicon-user"></span>
                            <div class="labelPhoto">Nustatyti kaip profilio nuotrauką</div>
                        </div>
                    </a>
                    <a href="<?= Url::to(['member/deletephoto', 'pureName' => $name['pure'], 'id' => $id]); ?>"
                       onclick="return confirm('Ar tikrai norite ištrinti nuotrauką?');">
                        <div class="col-xs-6"><span class="glyphicon glyphicon-trash"></span>
                            <div class="labelPhoto">Trinti</div>
                        </div>
                    </a>
                </div>

                <div class="row">
                    <div class="col-xs-6 less" data-trigger="<?= $name['pure'] ?>"><span
                            class="glyphicon glyphicon-resize-small"></span></div>
                    <a href="<?= Url::to(['member/rotate', 'pureName' => $name['pure'], 'id' => $id]); ?>"
                       onclick="return confirm('Ar tikrai norite pasukti šią nuotrauką į dešinę?');">
                        <div class="col-xs-6"><span
                                class="glyphicon glyphicon-repeat"></span>
                            <div class="labelPhoto">Pasukti nuotrauką</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <?php
    }

//        var_dump($model->profile);
    ?>
<?php endforeach; ?>
