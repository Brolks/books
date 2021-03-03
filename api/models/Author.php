<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "author".
 *
 * @property int $author_id
 * @property string|null $name
 * @property string|null $modified
 * @property string|null $creatied
 */
class Author extends \yii\db\ActiveRecord
{
	public $name_author;
    /**
     * {@inheritdoc}
     */
	
    public static function tableName()
    {
        return 'author';
    }
	
	public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['creatied', 'modified'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['modified'],
                ],
                
                 'value' => date("Y-m-d h:m:s"),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['modified', 'creatied'], 'safe'],
            [['author_name'], 'string', 'max' => 255],
            [['author_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'author_id' => 'Author ID',
            'author_name' => 'Имя',
            'books.count_books' => 'Количество книг',
            'modified' => 'Modified',
            'creatied' => 'Creatied',
        ];
    }
	
    public function getBooks()
    {
        return $this->hasOne(Books::className(), ['author_id' => 'author_id'])->select(['books.author_id,COUNT(books.author_id) as count_books'])->groupBy(['books.author_id']);
    }
}
