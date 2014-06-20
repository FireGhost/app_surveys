<?php

class TakingsController extends Controller
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
            'GetSurvey + create'
        );
    }

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
			$taking->survey_id = $this->survey->id;

			$taking->state = "created";
			$taking->attributes=$_POST['Taking'];

			if($taking->save())
            {
                if (isset($_POST['Taking']['target_classes']))
                {
                    $target_classes = $_POST['Taking']['target_classes'];
                    foreach ($target_classes as $target_class) {
                        $intranetClass = new IntranetClass;
                        $classStudents = $intranetClass->find($target_class, array('alter[include]'=>'students'));
                        foreach ($classStudents->students as $student) {
                            $participation = new Participation;
                            $participation->type = ($taking->anonymous == 0) ? "KnownParticipation" : "AnonymousParticipation";
                            $participation->taking_id = $taking->id;
                            $participation->person_id = $student->id;
                            $participation->person_type = $student->type;
                            $participation->concrete_class = $target_class;
                            $participation->email = $student->email;
                            $participation->save();
                        }
                    }
                }
                //throw new CHttpException(44, print_r($taking));
				$this->redirect(array('view','id'=>$taking->id));
            }
		}
        else
        {
            $intranetClass = new IntranetClass;
            $classesObject = $intranetClass->find("all");
            $targetClasses[0] = "";
            foreach ($classesObject as $classSimple) {
                $targetClasses[$classSimple->id] = $classSimple->name;
            }
        }

		$this->render('create',array(
			'taking'=>$taking,
            'targetClasses'=>$targetClasses,
            //'targetPeople'=>$targetPeople,
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
        $this->render('view',array(
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
        
        $dataProvider=new CActiveDataProvider('Taking');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
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
    
    /**
     * Return true if the end date of this taking is out-of-date
     * @param integer $id The ID of the taking
     * @return True or False. Explicit enough
     */
    public function isLocked($id)
    {
        $taking = $this->loadTaking($id);
        
        $date = new DateTime();
        if ($date->format('Y-m-d H:i:s') > $taking->ends_at && !empty($taking->ends_at))
            return true;
        else
            return false;
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
    
}
