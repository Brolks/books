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
class UpdateController extends ActiveController
{
    public $modelClass = 'api\modules\books\models\Books';  
	
    public function actionNew(){
		$post = Yii::$app->request->post();
		
		$row = books::findOne($post['id']);
		
		$row->name =isset($post['name']) ? $post['name'] :$row->name;
		$row->author_id =isset($post['author_id']) ? $post['author_id'] :$row->author_id;
		
		$row->save();
	}
}


