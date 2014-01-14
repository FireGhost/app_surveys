<?php

/**
 * This is the model class for table "participations".
 *
 * The followings are the available columns in table 'participations':
 * @property integer $id
 * @property string $type
 * @property integer $taking_id
 * @property integer $person_id
 * @property string $participant_token
 */
class Participation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'participations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('taking_id', 'required'),
			array('taking_id, person_id', 'numerical', 'integerOnly'=>true),
			array('type, participant_token', 'length', 'max'=>63),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, taking_id, person_id, participant_token', 'safe', 'on'=>'search'),
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
			'takings' => array(self::BELONGS_TO, 'Taking', 'taking_id'),
			'answers' => array(self::HAS_MANY, 'Answer', 'participation_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type' => 'Type',
			'taking_id' => 'Taking',
			'person_id' => 'Person',
			'participant_token' => 'Participant Token',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('taking_id',$this->taking_id);
		$criteria->compare('person_id',$this->person_id);
		$criteria->compare('participant_token',$this->participant_token,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Participations the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
