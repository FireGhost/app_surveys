<?php

class QuestionsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    protected $questionGroup;
    
    public function filters()
    {
        return array(
            'GetQuestionGroup + create',
            'CanModifySurvey + create, update, delete'
        );
    }
    
    /**
     * Create a new question.
     * If creation is successful, the browser will be redirected to the survey editing page
     */
    public function actionCreate()
    {
        if (isset($_POST['Question'])) {
            $question = new $_POST['Question']['type'];
            $question->questionGroup = $this->questionGroup;
            
            // Prepare the 'settings' field for the DB
            // WARNING: array_filter will delete the '0' entries
            $_POST['Question']['settings'] = json_encode( array_filter($_POST['Question']['settings']) );
            
            
            // Add one to the position of the last question in the QuestionGroup
            if (! isset($_POST['Question']['position'])) {
                $question->position = $question->questionGroup->maxQuestion + 1;
            }
            
            $question->attributes=$_POST['Question'];
            if ($question->save())
                $this->redirect(array('surveys/view', 'id'=>$question->survey->id)); //TODO : Ancre pour scroller automatiquement jusqu'a la question que l'on vient de créer?
        }
        else {
            $question = new Question;
            $question->questionGroup = $this->questionGroup;
        }
        
        
        
        $this->render('create', array(
            'question'=>$question,
        ));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'question'=>$this->loadQuestion($id),
        ));
    }
    
    /**
     * Updates a question.
     * If update is successful, the browser will be redirected to the survey's update page
     * @param integer $id the ID of the question to be updated
     */
    public function actionUpdate($id)
    {
        $question=$this->loadQuestion($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($question);
        if(isset($_POST['Question']))
        {
            $question->attributes=$_POST['Question'];
            if($question->save())
                $this->redirect(array('surveys/update','id'=>$question->survey->id));
        }

        $this->render('update',array(
            'question'=>$question,
        ));
    }
    
    
    /**
     * Delete a question
     * If successful, redirect to the survey editing page
     * @param int $id the ID of the question to be deleted
     */
     public function actionDelete($id)
     {
         $question = $this->loadQuestion($id);
         $surveyID = $question->survey->id;
         
         if ( $question->delete() )
            $this->redirect(array('surveys/update', 'id'=>$surveyID));
         else
            $this->redirect(array('questions/update', 'id'=>$id));
     }


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Question the loaded model
     * @throws CHttpException
     */
    public function loadQuestion($id)
    {
        $question=Question::model()->findByPk($id);
        if($question===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $question;
    }
    
    
    /**
     * Load the question group specified in the URL
     */
    public function filterGetQuestionGroup($filterChain)
    {
        // Take the good questionGroup id from the survey/update page and verify it
        if (isset($_GET['gid'])) {
            if (!($this->questionGroup = QuestionGroup::model()->findByPk($_GET['gid'])))
                throw new CHttpException(404, 'The question group assiocated to this question does not exist. To create a question, use the link in the survey edit page.');
        }
        else
            throw new CHttpException(404, 'The question group ID is not specified. To create a question, use the link in the survey edit page.');
        
        $filterChain->run();
    }
    
    /**
     * Throw an error message when the survey is locked
     */
    public function filterCanModifySurvey($filterChain)
    {
         $this->canModifySurvey($filterChain, $this->questionGroup ? $this->questionGroup->survey : $this->loadQuestion($_GET['id'])->survey);
    }
}
