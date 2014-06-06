<?php

class SurveysController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';


	public function filters()
    {
        return array(
            'CanModifySurvey + update, delete'
        );
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$survey=new Survey;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($survey);

		if(isset($_POST['Survey']))
		{
			$survey->attributes=$_POST['Survey'];
			if($survey->save())
				$this->redirect(array('view','id'=>$survey->id));
		}

		$this->render('create',array(
			'survey'=>$survey,
		));
	}


	 /**
     * Updates a survey.
     * If update is successful, the browser will be redirected to the survey's update page
     * @param integer $id the ID of the survey to be updated
     */
    public function actionUpdate($id)
    {
        $survey=$this->loadsurvey($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($survey);
        if(isset($_POST['Survey']))
        {
            $survey->attributes=$_POST['Survey'];
            if($survey->save())
                $this->redirect(array('surveys/view','id'=>$survey->id));
        }

        $this->render('update',array(
            'survey'=>$survey,
        ));
    }
    
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Survey');
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
			'survey'=>$this->loadSurvey($id),
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Survey the loaded model
	 * @throws CHttpException
	 */
	public function loadSurvey($id)
	{
		$survey=Survey::model()->findByPk($id);
		if($survey===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $survey;
	}

	/**
     * Throw an error message when the survey is locked
     */
    public function filterCanModifySurvey($filterChain)
    {
        $this->canModifySurvey($filterChain, $this->loadSurvey($_GET['id']));
    }
}
