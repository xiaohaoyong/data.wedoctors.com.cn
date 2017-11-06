<?php
namespace app\components\behavior;

/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/2/24
 * Time: 15:40
 */
class FollowBehavior extends \yii\base\Behavior
{

    public $touserid ; //被访问用户ID\
    public $event_name="user_follow_state";
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
    public function user_follow_state($event)
    {
        if(\Yii::$app->user->id)
        {
            \app\models\Follow::$Behavior_UserInfo=false;
            $event->sender->follow_state=\app\models\Follow::user_follow_state(\Yii::$app->user->id,$event->sender->userid);
        }else{
            $event->sender->follow_state=0;
        }
    }
    public function user_follow_num($event)
    {
        \app\models\Follow::$Behavior_UserInfo=false;
        $event->sender->fieldsReturn="view";
        $event->sender->followNum=\app\models\Follow::find()->where(['userid'=>$event->sender->userid])->count();
        $event->sender->fansNum=\app\models\Follow::find()->where(['touserid'=>$event->sender->userid])->count();
    }
}