<?php

class PropositionsController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';
    
    protected $question;

    public function filters()
    {
        return array(
            'GetQuestion', 
            'CanModifySurvey + update, create, delete',
        );
    }
    
    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $proposition=$this->loadProposition($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($proposition);

        if(isset($_POST['Proposition']))
        {
            $proposition->attributes=$_POST['Proposition'];
            if($proposition->save())
                $this->redirect(array('surveys/view','id'=>$proposition->survey->id));
        }

        $this->render('update',array(
            'proposition'=>$proposition,
        ));
    }
    
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$proposition=new Proposition;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($proposition);

		if(isset($_POST['Proposition']))
		{
			$proposition->attributes=$_POST['Proposition'];

			$proposition->question = $this->question;
			
        	$proposition->position = $proposition->question->maxProposition+1;

			if($proposition->save())
				$this->redirect(array('view','id'=>$proposition->id));
            
            // TODO: Impossible to save new propositions !!!
		}

		$this->render('create',array(
			'model'=>$proposition,
		));
	}
          
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'proposition'=>$this->loadProposition($id),
        ));
    }


    /**
	 * Deletes a particular proposition.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the proposition to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadProposition($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
        
     /**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Proposition');
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
	}
    
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Question the loaded model
     * @throws CHttpException
     */
    public function loadProposition($id)
    {
        $proposition=Proposition::model()->findByPk($id);
        if($proposition===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $proposition;
    }
    
    /**
     * Load the question specified in the URL
     */
    public function filterGetQuestion($filterChain)
    {
        if (isset($_GET['qid']))
            $this->question = Question::model()->findByPk($_GET['qid']);
        else
        {
            $this->question = $this->loadProposition($_GET['id'])->question;
        }
        $filterChain->run();
    }
    
    /**
     * Throw an error message when the survey is locked
     */
    public function filterCanModifySurvey($filterChain)
    {
        if (isset($_GET['id']))
            $this->canModifySurvey($filterChain, $this->loadProposition($_GET['id'])->survey);
        else if (isset($_GET['qid']))
            $this->canModifySurvey($filterChain, Question::model()->findByPk($_GET['qid'])->survey); //TODO : see if we can make that cleaner
        else
            throw new CHttpException(404, 'No proposition ID or question ID specified. To create a proposition, use the link in the survey edit page.');
    }

}