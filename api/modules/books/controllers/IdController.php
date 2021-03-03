<?php

namespace api\modules\books\controllers;

use yii\rest\ActiveController;
use yii;
use app\models\books;

/**
 * Books Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class IdController extends ActiveController
{
    public $modelClass = 'api\modules\books\models\Books';  
	
	
    public function actionNew(){
		$row = books::findOne(Yii::$app->request->post('id'));
		
		$row->delete();
	}
}


