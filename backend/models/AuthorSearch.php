<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Author;

/**
 * AuthorSearch represents the model behind the search form of `app\models\Author`.
 */
class AuthorSearch extends Author
{
	public $count_books;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id'], 'integer'],
            [['author_name', 'creatied','count_books'], 'safe'],
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
        $query = Author::find()->select('books.author_id,author.author_id,author.author_name,author.modified,author.creatied, count(books.author_id) as count_books');
		$query->joinWith(['books']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'sort' => ['attributes' => [
                   'author_id',
                   'author_name',
                   'modified',
                   'creatied',
                   'count_books' => [
                        'asc' => ['count_books' => SORT_ASC],
                        'desc' => ['count_books' => SORT_DESC],
                        'default' => SORT_DESC
                   ],
              ],],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'author_id' => $this->author_id,
        ]);
		
		if($this->count_books!='')
			$query->having($this->count_books.'='.'COUNT(books.author_id)');
		if(isset($this->creatied))
			$query->andFilterWhere(['between', 'author.creatied', date("Y-m-d h:y",strtotime($this->creatied)-86400),date("Y-m-d h:y",strtotime($this->creatied))]);
        $query->andFilterWhere(['like', 'author_name', $this->author_name]);

        return $dataProvider;
    }
}
