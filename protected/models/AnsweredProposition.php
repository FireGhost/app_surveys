<?php

/**
 * This is the model class for table "answered_propositions".
 *
 * The followings are the available columns in table 'answered_propositions':
 * @property integer $id
 * @property integer $answer_id
 * @property integer $proposition_id
 * @property string $body
 * @property integer $position
 *
 * The followings are the available model relations:
 * @property Answers $answer
 * @property Propositions $proposition
 */
class AnsweredProposition extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'answered_propositions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('participation_id, proposition_id', 'required'),
			array('participation_id, proposition_id, value', 'numerical', 'integerOnly'=>true),
            array('created_at, updated_at', 'safe'),
			array('body', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, participation_id, proposition_id, body, value, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'participation' => array(self::BELONGS_TO, 'Participation', 'participation_id'),
			'proposition' => array(self::BELONGS_TO, 'Proposition', 'proposition_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'participation_id' => 'Participation',
			'proposition_id' => 'Proposition',
			'body' => 'Body',
			'value' => 'Value',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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
		$criteria->compare('participation_id',$this->participation_id);
		$criteria->compare('proposition_id',$this->proposition_id);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('value',$this->value);
        $criteria->compare('created_at',$this->created_at,true);
        $criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AnsweredProposition the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
