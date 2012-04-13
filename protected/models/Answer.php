<?php

/**
 * This is the model class for table "{{answer}}".
 *
 * The followings are the available columns in table '{{answer}}':
 * @property integer $id
 * @property integer $ask_id
 * @property integer $uid
 * @property string $username
 * @property string $ip
 * @property integer $is_adopt
 * @property string $content
 * @property integer $created
 * @property integer $modified
 *
 * The followings are the available model relations:
 * @property Ask $ask
 */
class Answer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Answer the static model class
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
		return '{{answer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ask_id, uid, username, ip, content, created, modified', 'required'),
			array('ask_id, uid, is_adopt, created, modified', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>45),
			array('ip', 'length', 'max'=>1),
			array('content', 'length', 'max'=>2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ask_id, uid, username, ip, is_adopt, content, created, modified', 'safe', 'on'=>'search'),
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
			'ask' => array(self::BELONGS_TO, 'Ask', 'ask_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ask_id' => 'Ask',
			'uid' => 'Uid',
			'username' => 'Username',
			'ip' => 'Ip',
			'is_adopt' => 'Is Adopt',
			'content' => 'Content',
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
		$criteria->compare('ask_id',$this->ask_id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('is_adopt',$this->is_adopt);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('modified',$this->modified);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}