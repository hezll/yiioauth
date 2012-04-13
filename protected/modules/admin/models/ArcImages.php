<?php

/**
 * This is the model class for table "{{arc_images}}".
 *
 * The followings are the available columns in table '{{arc_images}}':
 * @property integer $id
 * @property integer $articles_id
 * @property integer $category_id
 * @property string $images
 * @property string $image_path
 * @property string $content
 *
 * The followings are the available model relations:
 * @property Articles $articles
 * @property Category $category
 */
class ArcImages extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArcImages the static model class
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
		return '{{arc_images}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('articles_id, category_id, images, image_path, content', 'required'),
			array('articles_id, category_id', 'numerical', 'integerOnly'=>true),
			array('images', 'length', 'max'=>2000),
			array('image_path', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, articles_id, category_id, images, image_path, content', 'safe', 'on'=>'search'),
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
			'articles' => array(self::BELONGS_TO, 'Articles', 'articles_id'),
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
			'articles_id' => 'Articles',
			'category_id' => 'Category',
			'images' => 'Images',
			'image_path' => 'Image Path',
			'content' => 'Content',
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
		$criteria->compare('articles_id',$this->articles_id);
		$criteria->compare('category_id',$this->category_id);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('image_path',$this->image_path,true);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}