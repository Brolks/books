<?php

namespace api\modules\books\controllers;

use yii\rest\ActiveController;
use yii;
use yii\web\Response;
use app\models\books;

/**
 * Books Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class BooksController extends ActiveController
{
    public $modelClass = 'api\modules\books\models\Books';  
	
	
    public function actionNew(){
		parent::init();
        Yii::$app->response->format = Response::FORMAT_JSON;
		$var_damp=books::find()->joinWith(['author'])->asArray()->all();
		for($i=0,$n=count($var_damp);$i<$n;$i++){
			$var_damp[$i]['author']=$var_damp[$i]['author']['author_name'];
		}
		return $var_damp;
	}
}


