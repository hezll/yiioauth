<?php

/**
 * This is the model class for table "{{articles}}".
 *
 * The followings are the available columns in table '{{articles}}':
 * @property integer $id
 * @property integer $category_id
 * @property string $category_path
 * @property string $title
 * @property string $uid
 * @property string $username
 * @property string $author
 * @property string $thumb
 * @property string $flag
 * @property string $redirecturl
 * @property integer $visit_count
 * @property string $description
 * @property string $seo_keywords
 * @property string $seo_title
 * @property integer $created
 * @property integer $modified
 *
 * The followings are the available model relations:
 * @property ArcArticle[] $arcArticles
 * @property ArcImages[] $arcImages
 * @property Category $category
 */
class Articles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Articles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{articles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, category_path, title, uid, username, author, thumb, flag, redirecturl, description, seo_keywords, seo_title', 'required'),
			array('category_id, visit_count, created, modified', 'numerical', 'integerOnly'=>true),
			array('category_path, title, uid, username, author', 'length', 'max'=>45),
			array('thumb, redirecturl', 'length', 'max'=>100),
			array('description, seo_keywords, seo_title', 'length', 'max'=>200),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, category_id, category_path, title, uid, username, author, thumb, flag, redirecturl, visit_count, description, seo_keywords, seo_title, created, modified', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'arcArticles' => array(self::HAS_MANY, 'ArcArticle', 'articles_id'),
			'arcImages' => array(self::HAS_MANY, 'ArcImages', 'articles_id'),
			'category' => array(self::BELONGS_TO, 'Category', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => 'Category',
			'category_path' => 'Category Path',
			'title' => 'Title',
			'uid' => 'Uid',
			'username' => 'Username',
			'author' => 'Author',
			'thumb' => 'Thumb',
			'flag' => 'Flag',
			'redirecturl' => 'Redirecturl',
			'visit_count' => 'Visit Count',
			'description' => 'Description',
			'seo_keywords' => 'Seo Keywords',
			'seo_title' => 'Seo Title',
			'created' => 'Created',
			'modified' => 'Modified',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('category_path',$this->category_path,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('thumb',$this->thumb,true);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('redirecturl',$this->redirecturl,true);
		$criteria->compare('visit_count',$this->visit_count);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('modified',$this->modified);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}