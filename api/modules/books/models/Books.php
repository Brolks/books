<?php
namespace api\modules\books\models;
use \yii\db\ActiveRecord;
/**
 * Country Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class Books extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'books';
	}

    /**
     * @inheritdoc
     */
    public static function primaryKey()
    {
        return ['books_id'];
    }

    /**
     * Define rules for validation
     */
    public function rules()
    {
        return [
            [['books_id', 'name', 'author_id'], 'required']
        ];
    }
}
