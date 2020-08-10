<?php


namespace frontend\controllers;

use common\models\Subscriber;
use common\models\User;
use common\models\Video;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class ChannelController extends Controller{

    public function behaviors()
    {
        return [
            "access" => [
                "class" => AccessControl::class,
                'only' => ['subscribe'],
                'rules' => [
                    [
                        "allow" => true,
                        'roles' => ["@"]
                    ]
                ]
            ]
            // 'verbs' => [
            //     "class" => VerbFilter::class,
            //     "actions" => [
            //         "subscribe" => ['post']
            //     ]
            // ]
        ];     
    }

    public function actionView($username){
       $channel = $this->findChannel($username);

       $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->creator($channel->id)->published()
       ]);

       return $this->render("view", [
            'channel' => $channel,
            'dataProvider' => $dataProvider
       ]);
    }

    public function actionSubscribe($username){
        $channel = $this->findChannel($username);

        $userId = Yii::$app->user->id;

        $subscriber = $channel->isSubscribed($userId);

        if(!$subscriber){
            $subscriber = new Subscriber();
            $subscriber->channel_id = $channel->id;
            $subscriber->user_id = $userId;
            $subscriber->created_at = time();

            $subscriber->save();
            Yii::$app->mailer->compose([
                'html' => 'subscriber-html', 'text' => 'subscriber-text'
            ], [
                'channel' => $channel,
                'user' => Yii::$app->user->identity
            ])->setFrom(Yii::$app->params["senderEmail"])
            ->setTo($channel->email)
            ->setSubject("You have a new sbscriber")
            ->send();
        }else{
            $subscriber->delete();
        }

        return $this->renderAjax("_subscribe", [
            "channel" => $channel
        ]);
    }

    protected function findChannel($username){
        $channel = User::findByUsername($username);
        if(!$channel){
            throw new NotFoundHttpException("Channel does not found");
        }

        return $channel;
    }
}