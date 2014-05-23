<?php

class TakingsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$taking=new Taking;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($taking);

		if(isset($_POST['Taking']))
		{
			$taking->survey_id = 1; //TODO: get that ID automatically. See the work on "questions" done by FireGhost
			$taking->state = "created";
			$taking->attributes=$_POST['Taking'];
			if($taking->save())
				$this->redirect(array('view','id'=>$taking->id));
		}

		$this->render('create',array(
			'taking'=>$taking,
		));
	}
    
    /**
     * Display the taking to respond
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'taking'=>$this->loadTaking($id),
        ));
    }
    
    
    /**
     * Will save the answers of a respondant
     */
    public function actionSaveAnswers($id)
    {
        $taking = $this->loadTaking($id);
         
        if (isset($_POST) && !empty($_POST)) {
             
            $participation = Participation::model()->findByPk(1); // TODO: Get the correct participation
             
            foreach ($_POST['Questions'] as $qid => $data) {
                if ( $question = $taking->survey->questions( array('condition'=>'questions.id='.$qid) )[0] ) {
                    
                    $userInput = ( isset($_POST['UserInputs'][$qid]) ? $_POST['UserInputs'][$qid] : null );
                    if (! $question->saveAnswer($data, $participation, $userInput) ) {
                        $this->render('view',array(
                            'taking'=>$taking,
                        ));
                    }
                    
                }
            }
        }
        
        $this->render('index',array(
            'taking'=>$taking,
        ));
     }
    

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Taking the loaded model
	 * @throws CHttpException
	 */
	public function loadTaking($id)
	{
		$taking=Taking::model()->findByPk($id);
		if($taking===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $taking;
	}
}
