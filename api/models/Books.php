<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\author;

/**
 * This is the model class for table "books".
 *
 * @property int $books_id
 * @property int $author_id
 * @property string $name
 * @property string|null $modified
 * @property string|null $creatied
 */
class Books extends \yii\db\ActiveRecord
{
	public $count_books;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
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
            [['author_id', 'name'], 'required'],
            [['books_id', 'author_id'], 'integer'],
            [['modified', 'creatied'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['books_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'books_id' => 'Books ID',
            'author_id' => 'Author ID',
            'name' => 'Name',
            'modified' => 'Modified',
            'creatied' => 'Creatied',
        ];
    }
	
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['author_id' => 'author_id'])->select(['*, `author`.author_name as name_author']);
    }
}
