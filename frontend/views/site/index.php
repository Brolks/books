<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                 <?= GridView::widget([
					'dataProvider' => $dataProvider,
					'columns' => [

						['attribute'=>'books_id','enableSorting' => false],
						['attribute'=>'author_name','value'=>'author.author_name'],
						['attribute'=>'author_id','enableSorting' => false],
						['attribute'=>'name','enableSorting' => false],
						['attribute'=>'modified','enableSorting' => false],
						[
							'enableSorting' => false,
							'attribute'=>'creatied',
							'content'=>function($data){
								//return print_r($data,1);
								return Yii::$app->formatter->asDate($data->creatied, 'long');
							}
						],
					],
				]); ?>
            </div>
        </div>
    </div>
</div>
