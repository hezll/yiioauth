<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';

	/**
	 * Displays the login page
	 */
        public function actionOauthSina(){
            Yii::app()->getRequest()->redirect(OpentHelper::getUrl('sina'));
        }
        public function actionOauthQQ(){
           Yii::app()->getRequest()->redirect(OpentHelper::getUrl('qq')); 
        }
        public function actionOauthSohu(){
           Yii::app()->getRequest()->redirect(OpentHelper::getUrl('sohu')); 
        }
	public function actionLogin()
	{            
		if (Yii::app()->user->isGuest) {
                    $aurls =array('sohu'=>array('login/oauthsohu'),'qq'=>array('login/oauthqq'),'sina'=>array('login/oauthsina'));
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					if (strpos(Yii::app()->user->returnUrl,'/index.php')!==false)
						$this->redirect(Yii::app()->controller->module->returnUrl);
					else
						$this->redirect(Yii::app()->user->returnUrl);
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model,'aurls'=>$aurls));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
                $lastVisit->ip = Yii::app()->request->userHostAddress;
		$lastVisit->save();
	}

}