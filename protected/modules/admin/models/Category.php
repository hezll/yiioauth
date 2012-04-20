<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property integer $id
 * @property integer $topid
 * @property integer $pid
 * @property string $typename
 * @property integer $sort
 * @property integer $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property ArcArticle[] $arcArticles
 * @property ArcImages[] $arcImages
 * @property Articles[] $articles
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return '{{category}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, typename, sort, created', 'required'),
			array('topid, pid, sort, created', 'numerical', 'integerOnly'=>true),
			array('typename', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, topid, pid, typename, sort, created, modified', 'safe', 'on'=>'search'),
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
			'arcArticles' => array(self::HAS_MANY, 'ArcArticle', 'category_id'),
			'arcImages' => array(self::HAS_MANY, 'ArcImages', 'category_id'),
			'articles' => array(self::HAS_MANY, 'Articles', 'category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'typename' => '分类名称',
			'pid' => '父分类ID',
			'sort' => '排序',
			'created' => '创建日期',
			'modified' => '编辑日期',
		);
	}
    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created',
                'updateAttribute' => 'modified',
            )
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
		$criteria->compare('typename',$this->typename,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}