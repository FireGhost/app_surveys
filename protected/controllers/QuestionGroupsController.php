<?php

class QuestionGroupsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	protected $survey;
    
    public function filters()
    {
        return array(
        	'GetSurvey + create',
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

			$questionGroup->survey_id = $this->survey->id;
			
        	$questionGroup->position = $questionGroup->survey->maxQuestionGroup+1;

			if($questionGroup->save())
				$this->redirect(array('surveys/view','id'=>$this->survey->id));
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
                $this->redirect(array('surveys/update','id'=>$questionGroup->survey->id));
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
     * Load the survey specified in the URL
     */
    public function filterGetSurvey($filterChain)
    {
        // Take the good questionGroup id from the survey/update page and verify it
        if (isset($_GET['sid'])) {
            if (!($this->survey = Survey::model()->findByPk($_GET['sid'])))
                throw new CHttpException(404, 'The survey assiocated to this question group does not exist. To create a question group, use the link in the survey edit page.');
        }
        else
            throw new CHttpException(404, 'The survey ID is not specified. To create a question group, use the link in the survey edit page.');
        
        $filterChain->run();
    }

    /**
     * Throw an error message when the survey is locked
     */
    public function filterCanModifySurvey($filterChain)
    {
        if (isset($_GET['id']))
            $this->canModifySurvey($filterChain, $this->loadQuestionGroup($_GET['id'])->survey);
        else if (isset($_GET['sid']))
            $this->canModifySurvey($filterChain, Survey::model()->findByPk($_GET['sid'])); //TODO : see if we can make that cleaner
        else
            throw new CHttpException(404, 'No Question Group ID or Survey ID specified. To create a Question Group, use the link in the survey edit page.');
    }
}
