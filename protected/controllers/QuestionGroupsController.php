<?php

class QuestionGroupsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
    
	
    public function filters()
    {
        return array(
            'CanModifySurvey + update, create, delete',
        );
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$questionGroup=new QuestionGroup;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($questionGroup);

		if(isset($_POST['QuestionGroup']))
		{
			$questionGroup->attributes=$_POST['QuestionGroup'];

			$questionGroup->survey_id = $this->survey_id;
			
        	$questionGroup->position = $questionGroup->survey->maxQuestionGroup+1;

			if($questionGroup->save())
				$this->redirect(array('view','id'=>$questionGroup->id));
		}

		$this->render('create',array(
			'questionGroup'=>$questionGroup,
		));
	}

	/**
 	* Lists all models.
 	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('QuestionGroup');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'questionGroup'=>$this->loadQuestionGroup($id),
		));
	}

    /**
     * Updates a questiongroup.
     * If update is successful, the browser will be redirected to the survey's update page
     * @param integer $id the ID of the questiongroup to be updated
     */
    public function actionUpdate($id)
    {
        $questionGroup=$this->loadQuestionGroup($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($question);

        if(isset($_POST['QuestionGroup']))
        {
            $questionGroup->attributes=$_POST['QuestionGroup'];
            if($questionGroup->save())
                $this->redirect(array('surveys/view','id'=>$questionGroup->survey->id));
        }

        $this->render('update',array(
            'questionGroup'=>$questionGroup,
        ));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return QuestionGroup the loaded model
	 * @throws CHttpException
	 */
	public function loadQuestionGroup($id)
	{
		$questionGroup=QuestionGroup::model()->findByPk($id);
		if($questionGroup===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $questionGroup;
	}

    /**
     * Throw an error message when the survey is locked
     */
    public function filterCanModifySurvey($filterChain)
    {
        $this->canModifySurvey($filterChain, $this->loadQuestionGroup($_GET['id'])->survey);
    }
}
