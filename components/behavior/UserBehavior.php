<?php
namespace app\components\behavior;
use app\models\UserInfo;

/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/2/24
 * Time: 15:40
 */
class UserBehavior extends \yii\base\Behavior
{
    public $event_name="user_info";
    public $field ;
    public $user;
    /**
     * Declares event handlers for the [[owner]]'s events.
     *
     * Child classes may override this method to declare what PHP callbacks should
     * be attached to the events of the [[owner]] component.
     *
     * The callbacks will be attached to the [[owner]]'s events when the behavior is
     * attached to the owner; and they will be detached from the events when
     * the behavior is detached from the component.
     *
     * The callbacks can be any of the following:
     *
     * - method in this behavior: `'handleClick'`, equivalent to `[$this, 'handleClick']`
     * - object method: `[$object, 'handleClick']`
     * - static method: `['Page', 'handleClick']`
     * - anonymous function: `function ($event) { ... }`
     *
     * The following is an example:
     *
     * ```php
     * [
     *     Model::EVENT_BEFORE_VALIDATE => 'myBeforeValidate',
     *     Model::EVENT_AFTER_VALIDATE => 'myAfterValidate',
     * ]
     * ```
     *
     * @return array events (array keys) and the corresponding event handler methods (array values).
     */
    public function events()
    {
        return [\app\models\Models::EVENT_AFTER_FIND=>$this->event_name];
    }
    public function user_info($event)
    {
        $user=\app\models\UserInfo::findOne(['userid'=>$event->sender->id]);
        $event->sender->user=$user?$user:new \stdClass();//Anchor::find()->where(['userid'=>$event->sender->userid])->asArray()->one();
    }
}