<?php

/**
 * This is the model class for table "{{ask}}".
 *
 * The followings are the available columns in table '{{ask}}':
 * @property integer $id
 * @property integer $asktype_id
 * @property integer $asktype_subid
 * @property string $title
 * @property string $content
 * @property integer $uid
 * @property string $username
 * @property integer $is_del
 * @property integer $is_top
 * @property integer $is_recommend
 * @property integer $status
 * @property integer $answer_count
 * @property integer $visit_count
 * @property integer $lastanswer_time
 * @property integer $expired_time
 * @property integer $solve_time
 * @property string $ip
 * @property integer $created
 * @property integer $modified
 *
 * The followings are the available model relations:
 * @property Answer[] $answers
 * @property AskType $asktype
 */
class Ask extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ask the static model class
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
		return '{{ask}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asktype_id, asktype_subid, title, content, uid, username, ip', 'required'),
			array('asktype_id, asktype_subid, uid, is_del, is_top, is_recommend, status, answer_count, visit_count, lastanswer_time, expired_time, solve_time, created, modified', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('content', 'length', 'max'=>1000),
			array('username', 'length', 'max'=>45),
			array('ip', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, asktype_id, asktype_subid, title, content, uid, username, is_del, is_top, is_recommend, status, answer_count, visit_count, lastanswer_time, expired_time, solve_time, ip, created, modified', 'safe', 'on'=>'search'),
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
			'answers' => array(self::HAS_MANY, 'Answer', 'ask_id'),
			'asktype' => array(self::BELONGS_TO, 'AskType', 'asktype_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'asktype_id' => 'Asktype',
			'asktype_subid' => 'Asktype Subid',
			'title' => 'Title',
			'content' => 'Content',
			'uid' => 'Uid',
			'username' => 'Username',
			'is_del' => 'Is Del',
			'is_top' => 'Is Top',
			'is_recommend' => 'Is Recommend',
			'status' => 'Status',
			'answer_count' => 'Answer Count',
			'visit_count' => 'Visit Count',
			'lastanswer_time' => 'Lastanswer Time',
			'expired_time' => 'Expired Time',
			'solve_time' => 'Solve Time',
			'ip' => 'Ip',
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
		$criteria->compare('asktype_id',$this->asktype_id);
		$criteria->compare('asktype_subid',$this->asktype_subid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('is_del',$this->is_del);
		$criteria->compare('is_top',$this->is_top);
		$criteria->compare('is_recommend',$this->is_recommend);
		$criteria->compare('status',$this->status);
		$criteria->compare('answer_count',$this->answer_count);
		$criteria->compare('visit_count',$this->visit_count);
		$criteria->compare('lastanswer_time',$this->lastanswer_time);
		$criteria->compare('expired_time',$this->expired_time);
		$criteria->compare('solve_time',$this->solve_time);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('modified',$this->modified);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}