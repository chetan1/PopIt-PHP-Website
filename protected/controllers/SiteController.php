<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}
    
    public function actionSearch() {
        
        $query = mysql_escape_string($_GET['q']);


        if($query != '')
        {
            $results = Prs::search($query);
            $this->render('search',array(
                    'result'=>$results,
                    'query'=>$query,
            ));
        }
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

    protected function actionSync()
    {
        Prs::sync();
    }

    protected function actionEmpty()
    {
        $popit = Prs::init();
        $popit->emptyInstance();
    }

    public function actionKeywords()
    {
        People::model()->populateKeywords();
    }

    public function actionSuggestions()
    {
        if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
        {
            $query = Prs::search($_GET['q']);
//            $keywords = Keyword::model()->findAll('keyword LIKE :query', array(':query'=>"%{$_GET['q']}%"));
            $result = array();

            if(count($query) > 0)
            {
                foreach($query as $k)
                    $result[] = $k['name'];

                echo implode("\n",$result);
            }
        }
    }

    public function actionPerson()
    {
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $instance = Prs::init();
            $result = $instance->get('person', $id);
            $person = (array)$result['result'];
            $person['summary'] = (array)json_decode($person['summary']);
            $this->render('person', array('person' => $person));
        }
    }
}