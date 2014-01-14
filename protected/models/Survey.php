<?php

/**
 * This is the model class for table "surveys".
 *
 * The followings are the available columns in table 'surveys':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property integer $created_for_id
 * @property integer $created_by_id
 * @property string $created_at
 * @property integer $updated_by_id
 * @property string $updated_at
 *
 * The followings are the available model relations:
 * @property QuestionGroups[] $questionGroups
 */
class Survey extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'surveys';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('created_for_id, created_by_id, updated_by_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('description, created_at, updated_at', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, created_for_id, created_by_id, created_at, updated_by_id, updated_at', 'safe', 'on'=>'search'),
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
			'questionGroups' => array(self::HAS_MANY, 'QuestionGroup', 'survey_id'),
			'takings' => array(self::HAS_MANY, 'Taking', 'survey_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'description' => 'Description',
			'created_for_id' => 'Created For',
			'created_by_id' => 'Created By',
			'created_at' => 'Created At',
			'updated_by_id' => 'Updated By',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('created_for_id',$this->created_for_id);
		$criteria->compare('created_by_id',$this->created_by_id);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('updated_by_id',$this->updated_by_id);
		$criteria->compare('updated_at',$this->updated_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Surveys the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
