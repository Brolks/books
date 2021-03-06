<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Books;

/**
 * BooksrSearch represents the model behind the search form of `app\models\Books`.
 */
class BooksSearch extends Books
{
	public $author_name;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['books_id', 'author_id'], 'integer'],
            [['name', 'creatied','author_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Books::find()->select('books.books_id,books.author_id,books.name,books.modified,books.creatied');
		$query->joinWith(['author']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'books_id' => $this->books_id,
            'author_id' => $this->author_id,
           // 'author.author_name' => $this->author_name,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
