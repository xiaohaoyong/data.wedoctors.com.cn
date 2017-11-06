<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2016/9/22
 * Time: 15:55
 */

namespace app\components;
use app\components\helper\UploadHelper;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;  //file 对象


    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png,jpg', 'maxFiles' => 4],
        ];
    }

    public function upload()
    {

        foreach($this->imageFiles as $k=>$v)
        {
            $type=$this->filetype2(file_get_contents($v->tempName));
            $v->name=$v->name.".".$type;
        }
        if ($this->validate()) {

            foreach ($this->imageFiles as $file) {
                $time=time();
                $filen=substr(md5($time.$file->tempName),4,14);
                $images[]=\Yii::$app->params['imageUrl'].$filen. '.' . $file->extension;
                $file->saveAs(__ROOT__."/../".\Yii::$app->params['imageDir']."/upload/" .$filen. '.' . $file->extension);
            }
            return $images;
        } else {
        }
    }
    /**
     * 根据二进制判断文件格式
     * @param $content 二进制流
     */
    public function filetype2($content)
    {
        $bin = substr($content,0,2);
        $strInfo = @unpack("C2chars", $bin);
        $typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
        $fileType = '';
        switch ($typeCode)
        {
            case 7790:
                $fileType = 'exe';
                break;
            case 7784:
                $fileType = 'midi';
                break;
            case 8297:
                $fileType = 'rar';
                break;
            case 255216:
                $fileType = 'jpg';
                break;
            case 7173:
                $fileType = 'gif';
                break;
            case 6677:
                $fileType = 'bmp';
                break;
            case 13780:
                $fileType = 'png';
                break;
            default:
                echo 'unknown';
        }
        return $fileType;
    }
}