<?php

namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;
use frontend\models\UserPack;
use yii\db\Query;

class SearchTopP extends UserPack
{
    //left filters
    public $username;
    public $vyras;
    public $moteris;
    public $amzius1;
    public $amzius2;
    public $ugis1;
    public $ugis2;
    public $svoris1;
    public $svoris2;
    public $miestas;
    public $rs;
    public $ts;
    public $se;
    public $f;
    public $sl;
    public $s;
    public $i;
    public $l;
    public $tu;
    public $ve;
    public $ve2;
    public $is;
    public $na;

    public $lastOnline;
    public $avatar;

    public $popularity;


    public function rules()
    {
        return [
            [['username', 'vip', 'lastOnline', 'avatar', 'amzius1','amzius2','ugis1','ugis2','svoris1','svoris2','miestas','rs','ts','se','f','sl','s','i','l','tu','ve','ve2','is','na','vyras','moteris', 'popularity'], 'safe'],
        ];
    }

    public function preLoad()
    {
        $user = Yii::$app->user->identity;
        $info = $user->info;
        $lytis = substr($info->iesko, 0, 1);

        /*
         *Orentacija
         *0-Bi
         *1-Hetero
         *2-Homo
         */

        if($info->orentacija == 1){
            if($lytis == "v"){
                $this->moteris = 1;
            }else{
                $this->vyras = 1;
            }
        }elseif ($info->orentacija == 2) {
            if($lytis == "m"){
                $this->vyras = 1;
            }else{
                $this->moteris = 1;
            }
        }

        $this->rs = 1;
        $this->ts = 1;
        $this->se = 1;
        $this->f = 1;
        $this->sl = 1;
        $this->s = 1;
        $this->i = 1;
        $this->l = 1;
        $this->tu = 1;
        $this->ve = 1;
        $this->ve2 = 1;
        $this->is = 1;
        $this->na = 1;
        $this->ugis1 = 51;
        $this->ugis2 = 91;
        $this->svoris1 = 11;
        $this->svoris2 = 143;
    }

    public function getTikslas()
    {
        $tikslas = [];

        if($this->rs)
            $tikslas[] = 0;
        if($this->ts)
            $tikslas[] = 1;
        if($this->se)
            $tikslas[] = 2;
        if($this->f)
            $tikslas[] = 3;
        if($this->sl)
            $tikslas[] = 4;
        if($this->s)
            $tikslas[] = 5;
        if(count($tikslas) == 6)
            $tikslas[] = 6;

        return $tikslas;
    }

    public function getStatusas()
    {
        $statusas = [];

        if($this->i)
            $statusas[] = 2;
        if($this->l)
            $statusas[] = 0;
        if($this->tu)
            $statusas[] = 1;
        if($this->ve)
            $statusas[] = 3;
        if($this->ve2)
            $statusas[] = 4;
        if($this->is)
            $statusas[] = 5;
        if($this->na)
            $statusas[] = 6;

        return $statusas;
    }

    public function leftFilters($query)
    {
        $query->filterWhere(['like', 'username', $this->username]);

        if(!($this->vyras && $this->moteris)){
            if($this->vyras)
                $query->andFilterWhere(['info.iesko' => ['vv', 'vm']]);

            if($this->moteris)
                $query->andFilterWhere(['info.iesko' => ['mm', 'mv']]);
        }

        if($this->amzius1 && $this->amzius2){
            $a1 = time() - $this->amzius1 * 8760 * 3600;
            $a2 = time() - ($this->amzius2 + 1) * 8760 * 3600;
            $query->andFilterWhere(['between', 'info.gimimoTS', $a2, $a1]);
        }elseif($this->amzius1){
            $a1 = time() - $this->amzius1 * 8760 * 3600;
            $query->andFilterWhere(['<=', 'info.gimimoTS', $a1]);
        }elseif($this->amzius2){
            $a2 = time() - $this->amzius2 * 8760 * 3600;
            $query->andFilterWhere(['>=', 'info.gimimoTS', $a2]);
        }

        $query->andFilterWhere(['between', 'info.ugis', (int)$this->ugis1, (int)$this->ugis2])
            ->andFilterWhere(['between', 'info.svoris', (int)$this->svoris1, (int)$this->svoris2]);

        if($this->miestas - 1 >= 0)
            $query->andFilterWhere(['info.miestas' => $this->miestas - 1]);


        $query->andFilterWhere(['info.tikslas' => $this->getTikslas()]);

        $query->andFilterWhere(['info.statusas' => $this->getStatusas()]);

        if($this->lastOnline)
            $query->andFilterWhere(['>=', 'lastOnline', time() - 600]);

        if($this->avatar)
            $query->andFilterWhere(['avatar' => ['jpg', 'jpeg', 'gif', 'png', 'raw', 'tif']]);

        if($this->vip)
            $query->andFilterWhere(['vip' => 1]);



        $query->andFilterWhere(['not', ['user.id' => Yii::$app->user->id]]);

        return $query;
    }

    public function searchTop()
    {
        # code...
    }

    public function search($params)
    {
        
        $query = UserStatsPack::find()->joinWith(['info','statistics']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 18,
            ],
            'sort'=> [
                'defaultOrder' => [
                    'popularity' => SORT_DESC,
                    'msgIn' => SORT_DESC,
                    'likes' => SORT_DESC,
                    'visits' => SORT_DESC,
                ]
            ]
        ]);

        $dataProvider->sort->attributes['popularity'] = [
            'asc' => ['statistics.p' => SORT_ASC],
            'desc' => ['statistics.p' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['msgIn'] = [
            'asc' => ['statistics.msg_recieved' => SORT_ASC],
            'desc' => ['statistics.msg_recieved' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['likes'] = [
            'asc' => ['statistics.likes' => SORT_ASC],
            'desc' => ['statistics.likes' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['visits'] = [
            'asc' => ['statistics.profile_visits' => SORT_ASC],
            'desc' => ['statistics.profile_visits' => SORT_DESC],
        ];

        //$dataProvider->sort->defaultOrder = ['popularity'=> SORT_ASC];

        $this->load($params);

        $this->leftFilters($query);
        //$this->searchTop($query);

        return $dataProvider;
                
    }


}
