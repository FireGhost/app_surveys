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
