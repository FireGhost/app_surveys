<?php

/**
 * This is the model class for table "propositions".
 *
 * The followings are the available columns in table 'propositions':
 * @property integer $id
 * @property string $type
 * @property integer $question_id
 * @property integer $position
 * @property string $title
 * @property string $answer_format
 * @property string $trigger_action
 * @property integer $trigger_target_id
 * @property string $trigger_target_type
 *
 * The followings are the available model relations:
 * @property AnsweredPropositions[] $answeredPropositions
 * @property Questions $question
 */
class Proposition extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'propositions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question_id, position', 'required'),
			array('question_id, position, trigger_target_id', 'numerical', 'integerOnly'=>true),
			array('type, trigger_action, trigger_target_type', 'length', 'max'=>63),
			array('title, answer_format', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, question_id, position, title, answer_format, trigger_action, trigger_target_id, trigger_target_type', 'safe', 'on'=>'search'),
            
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
			'answeredPropositions' => array(self::HAS_MANY, 'AnsweredProposition', 'proposition_id'),
			'question' => array(self::BELONGS_TO, 'Question', 'question_id'),
			'questionGroup' => array(self::HAS_ONE, 'QuestionGroup', array('question_group_id' => 'id'), 'through'=>'question'),
			'survey' => array(self::HAS_ONE, 'Survey', array('survey_id' => 'id'), 'through'=>'questionGroup')
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
			'question_id' => 'Question',
			'position' => 'Position',
			'title' => 'Title',
			'answer_format' => 'Answer Format',
			'trigger_action' => 'Trigger Action',
			'trigger_target_id' => 'Trigger Target',
			'trigger_target_type' => 'Trigger Target Type',
		);
	}
    
    
    public function answeredProposition($participationId)
    {
        $criteria = new CDbCriteria;
        $criteria->addCondition('participation_id=:participation_id');
        $criteria->addCondition('proposition_id=:proposition_id');
        $criteria->params = array(':proposition_id' => $this->id, ':participation_id' => $participationId); // TODO: Get automatically the good participation id
        return AnsweredProposition::model()->find($criteria);
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
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('position',$this->position);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('answer_format',$this->answer_format,true);
		$criteria->compare('trigger_action',$this->trigger_action,true);
		$criteria->compare('trigger_target_id',$this->trigger_target_id);
		$criteria->compare('trigger_target_type',$this->trigger_target_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Proposition the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
