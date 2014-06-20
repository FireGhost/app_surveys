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
			$taking->survey_id = $this->survey_id;
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
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $taking=$this->loadTaking($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($proposition);

        if(isset($_POST['Taking']))
        {
            $taking->attributes=$_POST['Taking'];
            $taking->starts_at= date('Y-m-d H:i:s',strtotime($taking->starts_at));
            $taking->ends_at= date('Y-m-d H:i:s',strtotime($taking->ends_at));

            if($taking->save())
                $this->redirect(array('surveys/view','id'=>$taking->survey->id));
        }

        $this->render('update',array(
            'taking'=>$taking,
        ));
    }
    
    /**
     * Display the taking to respond
     */
    public function actionView($id)
    {
        /*
        $this->render('view',array(
            'taking'=>$this->loadTaking($id),
        ));
        */
        $taking = $this->loadTaking($id);
        $dataProvider = new CActiveDataProvider('QuestionGroup', array(
            'criteria' => array(
                'condition' => 'survey_id='. $taking->survey->id
            ),
            'pagination' => array('pageSize' => 1)
        ));
        $this->render('view',array(
            'dataProvider'=>$dataProvider,
            'taking'=>$this->loadTaking($id),
        ));
    }
    
    
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Taking');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
    
    
    /**
     * Will save the answers of a respondent
     * @param integer $id the ID of the taking
     */
    public function actionSaveAnswers($id)
    {
        $taking = $this->loadTaking($id);
         
        if (isset($_POST) && !empty($_POST)) {
            array_filter($_POST['Questions']);
            Yii::trace("actionSaveAnswers: POST: ". print_r($_POST['Questions'], true));
             
            //$participation = Participation::model()->findByPk(1); // TODO: Get the correct participation
             
            /*
            foreach ($_POST['Questions'] as $qid => $data) {
                if ( $question = $taking->survey->questions( array('condition'=>'questions.id='.$qid) )[0] ) {
                    
                    $userInput = ( isset($_POST['UserInputs'][$qid]) ? $_POST['UserInputs'][$qid] : null );
                    if (! $question->saveAnswer($data, $participation, $userInput) ) {
                        /*
                        $this->render('view',array(
                            'taking'=>$taking,
                        ));
                        */
                        /*
                        echo "fail";
                    }
                    echo "good";
                    
                }
            }
            */
        }
        
        /*
        $dataProvider=new CActiveDataProvider('Taking');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
        */
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
    
    /**
     * Return true if the end date of this taking is out-of-date
     * @param integer $id The ID of the taking
     * @return True or False. Explicit enough
     */
    public function isLocked($id)
    {
        $taking = $this->loadTaking($id);
        
        $date = new DateTime();
        if ($date->format('Y-m-d H:i:s') > $taking->ends_at)
            return true;
        else
            return false;
    }
    
}
