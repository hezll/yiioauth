<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
        private $_id;
        public $email;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
            
            $user = $this->parseResponse($this->username);
            $platform = $this->password;
            if(!$user['status']){		
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }else{
                $model = User::model()->active()->findByAttributes(array('remote_id'=>$user['content']['id']));
                if(!$model){
                    $model = new RegistrationForm;
                    $model->remote_id = $user['content']['id'];
                    $model->createtime=time();
                } 
                $model->lastvisit=((Yii::app()->getModule('user')->loginNotActiv||(Yii::app()->getModule('user')->activeAfterRegister&&Yii::app()->getModule('user')->sendActivationMail==false))&&Yii::app()->getModule('user')->autoLogin)?time():0;       
                $model->username = $user['content']['screen_name'].'_'.$platform;//
                $model->platform = $platform;
                //$model->createtime=time();
                $model->ip=Yii::app()->request->userHostAddress;
                $model->superuser=0;
                $model->status=User::STATUS_ACTIVE;
		if($model->save(false)){//不用验证
                    $profile = Profile::model()->findbyPk($model->id); 
                    
                    if(!$profile){
                        $profile = new Profile; 
                        $profile->attributes = array();
                        $profile->user_id= $model->id;
                    }
                    $profile->regMode = true;   
                    if($profile->save(false)){ 
                        $this->_id=$model->id;
                        $this->username=$model->username;
                        $this->errorCode=self::ERROR_NONE;
                    }
                }				
            }
            return !$this->errorCode;
	}
        public function getId()
	{
		return $this->_id;
	}
        public function parseResponse($response){
            if ($response['status'] === false)
            {
                return $response;
            }
            switch ($this->password)
            {
                case 'sina':
                    $response['content'] = array(
                        'id' => $response['content']['id'],
                        'screen_name' => $response['content']['screen_name'],
                        'avatar' => $response['content']['profile_image_url'],
                        'followers_count' => $response['content']['followers_count'],
                        'friends_count' => $response['content']['friends_count'],
                        'statuses_count' => $response['content']['statuses_count'],
                        'verified' => $response['content']['verified'],
                    );
                    break;

                case 'sohu':
                    $response['content'] = array(
                        'id' => $response['content']['id'],
                        'screen_name' => $response['content']['screen_name'],
                        'avatar' => $response['content']['profile_image_url'],
                        'followers_count' => $response['content']['followers_count'],
                        'friends_count' => $response['content']['friends_count'],
                        'statuses_count' => $response['content']['statuses_count'],
                        'verified' => $response['content']['verified'],
                    );
                    break;
                case 'qq':
                    $response['content'] = array(
                        'id' => $response['content']['name'],
                        'screen_name' => $response['content']['nick'],
                        'avatar' => empty($response['content']['head']) ? '' : $response['content']['head'] . '/100', // qq头像连接后加头像大小, 最大为100
                        'followers_count' => $response['content']['fansnum'],
                        'friends_count' => $response['content']['idolnum'],
                        'statuses_count' => $response['content']['tweetnum'],
                        'verified' => $response['content']['isvip'],
                    );
                    break;

                default:
                    break;
            }
             return $response;
        }
}