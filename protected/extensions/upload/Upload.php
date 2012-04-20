<?php
/**
 * $upload: CUploadedFile::getInstance;
 * $type:  artilce product
 */
class Upload{

	private static function createUploadFile($upload, $type)
    {
        if (empty($type))
        {
            throw new CHttpException(500, 'variable type is not empty');
        }
		if ($upload == null)
        {
            return false;;
        }
		$upload_dir = Yii::app()->basePath.'/../uploads/'.$type.'/'.date('Ymd',time());
		if (!is_dir($upload_dir))
        {
			mkdir($upload_dir,'0777', true);
		}
		$imgname = time().'-'.rand().'.'.$upload->getExtensionName();
		//图片存储路径
		$imageurl = '/uploads/'.$type.'/'.date('Ymd',time()).'/'.$imgname;
		//存储绝对路径
		return $imageurl;
	}
    public static function createFile($upload, $type)
    {
        return self::createUploadFile($upload, 'file/' . $type);
    }
    public static function createImages($upload, $type)
    {
        return self::createUploadFile($upload, 'images/' . $type);
    }
    public static function createFlash($upload, $type)
    {
        return self::createUploadFile($upload, 'flash/' . $type);
    }
}