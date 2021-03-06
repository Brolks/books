<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksrSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'books_id',
            [
				'attribute'=>'author_name',
				'value'=>'author.author_name'
			],
            'author_id',
            'name',
            'modified',
			[
				'attribute'=>'creatied',
				'contentOptions' =>['class' => 'table_class','style'=>'display:block;'],
				'content'=>function($data){
					//return print_r($data,1);
					return Yii::$app->formatter->asDate($data->creatied, 'long');
				},
				'filter' => DateTimePicker::widget([
					'model' => $searchModel,
					'attribute' => 'creatied',
					'name' => 'datetime_10',
					'options' => ['placeholder' => ''],
					'convertFormat' => true,
					'pluginOptions' => [
						'format' => 'php:d.m.Y',
						'startDate' => '01-Mar-1960 12:00 AM',
						'todayHighlight' => true
					],
					'type'=>5
				]),
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
