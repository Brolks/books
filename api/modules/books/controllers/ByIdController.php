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
class ByIdController extends ActiveController
{
    public $modelClass = 'api\modules\books\models\Books';  
	
    public function actionNew(){
		parent::init(); Yii::$app->response->format = Response::FORMAT_JSON;
		
		return books::findOne(Yii::$app->request->get('id'));
	}
}


