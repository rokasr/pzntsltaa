<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;
use yii\helpers\Url;
use yii\helpers\BaseFileHelper;
use frontend\models\User;

class Payseracallback extends Model
{
    public function proceed() {

        $params = array();
        parse_str(base64_decode(strtr($_GET['data'], array('-' => '+', '_' => '/'))), $params);

        if(!$order = \frontend\models\Orders::find()->where(['id' => $params['orderid']])->one())
        {

            $uid = 2654;

            $order = new \frontend\models\Orders;
            $order->paysera_bankinis_id = $params['orderid'];
            $order->u_id = $uid;
            $order->params = $params['amount'];
            $order->action = "payserabankinisabonementas";
            $order->time = time();

            $vartotojas = \common\models\User::find()->where(['id' => $uid])->one();

            $vartotojas->vip = 1;

            $menesiuNr = 1;
            $savaite = 7 * 24 * 60 * 60;
            $addTime = $menesiuNr * 4 * $savaite;


            if($vartotojas->expires < time()){
                $vartotojas->expires = time() + $addTime;
            }else{
                $vartotojas->expires = $vartotojas->expires + $addTime;
            }

            if ($vartotojas->save())
            {
                echo 'OK '. $vartotojas->username .' abaonementas pratestas iki: '. date ("Y-m-d H:i", $vartotojas->expires);

                $order->done = 1;
            }
            else
            {
                echo 'FAIL Klaida pratesiant abonementa vartotojui'. $vartotojas->username;
                $order->done = 0;
            }

            $order->save();

        }
        else if ($order = \frontend\models\Orders::find()->where(['id' => $params['orderid']])->andWhere(['done' => 0])->one())
        {

            $vartotojas = \common\models\User::find()->where(['id' => $order->u_id])->one();
            $vartotojas->vip = 1;

            $menesiuNr = 1;
            $savaite = 7 * 24 * 60 * 60;
            $addTime = $menesiuNr * 4 * $savaite;

            if($vartotojas->expires < time()){
                $vartotojas->expires = time() + $addTime;
            }else{
                $vartotojas->expires = $vartotojas->expires + $addTime;
            }

            if ($vartotojas->save())
            {
                echo 'OK '. $vartotojas->username .' abonementas pratestas iki: '. date ("Y-m-d H:i", $vartotojas->expires);
                $order->done = 1;
            }
            else
            {
                echo 'FAIL Klaida pratesiant abonementa vartotojui'. $vartotojas->username;
                $order->done = 0;
            }

            $order->save();
        }
        else
            echo 'OK Abonementas jau buvo pratestas';

        //}
        /*
    }
    catch (Exception $e) {
        echo get_class($e).': '.$e->getMessage();
    }*/
    }

}

?>