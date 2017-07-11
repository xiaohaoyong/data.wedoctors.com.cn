<?php
namespace app\components\behavior;
use \app\models\RoomVod;

/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 2017/2/24
 * Time: 15:40
 */
class RoomBehavior extends \yii\base\Behavior
{
    public $event_name="rtmp_play";

    public $field ;
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
    public function rtmp_play($event)
    {
        if($event->sender->rtmp)
        {
            $rtmp_play=str_replace('push','play',$event->sender->rtmp);
            $rtmp_play=substr($rtmp_play,0,strpos($rtmp_play,"?"));
            $event->sender->rtmp=$rtmp_play;
        }
    }
    public function default_select_where($event)
    {
        $event->sender->find()->andFilterWhere(['>','state','-1']);
        $event->sender->find()->andFilterWhere(['>','level','-1']);
    }

    public function vod_list($event)
    {
        $room_vod=RoomVod::findAll(['type'=>1,'rid'=>$event->sender->id]);

        foreach ($room_vod as $k=>$v)
        {
            $event->sender->vod_list[]=$v->vod;
        }
    }
}