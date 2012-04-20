<?php

/**
 * This is the model class for table "{{ask_type}}".
 *
 * The followings are the available columns in table '{{ask_type}}':
 * @property integer $id
 * @property integer $pid
 * @property string $typename
 * @property integer $is_del
 * @property integer $sort
 * @property integer $created
 * @property integer $modified
 *
 * The followings are the available model relations:
 * @property Ask[] $asks
 */
class AskType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AskType the static model class
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
		return '{{ask_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('typename', 'required', 'message' => '分类名称不能为空'),
			array('pid, is_del, sort, created, modified', 'numerical', 'integerOnly'=>true),
			array('typename', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pid, typename, is_del, sort, created, modified', 'safe', 'on'=>'search'),
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
			'asks' => array(self::HAS_MANY, 'Ask', 'asktype_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'typename' => '类型名称',
			'sort' => '排序',
			'created' => '创建日期',
			'modified' => '编辑日期',
		);
	}
    public function getAskType($condition)
    {
        $asktype = $this->findAll($condition);
        return $asktype;
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
		$criteria->compare('pid',$this->pid);
		$criteria->compare('typename',$this->typename,true);
		$criteria->compare('is_del',$this->is_del);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('created',$this->created);
		$criteria->compare('modified',$this->modified);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}