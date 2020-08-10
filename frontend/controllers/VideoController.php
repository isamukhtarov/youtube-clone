<?php


namespace frontend\controllers;

use common\models\Video;
use common\models\VideoLike;
use common\models\VideoView;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\base\View;

class VideoController extends Controller{

    public function behaviors()
    {
        return [
            "access" => [
                "class" => AccessControl::class,
                'only' => ['like', 'dislike', 'history'],
                'rules' => [
                    [
                        "allow" => true,
                        'roles' => ["@"]
                    ]
                ]
            ],
            'verbs' => [
                "class" => VerbFilter::class,
                "actions" => [
                    "like" => ['post'],
                    "dislike" => ["post"]
                ]
            ]
        ];     
    }


    public function actionIndex(){
        $dataProvider = new ActiveDataProvider([
            'query' => Video::find()->with("createdBy")->published()->latest()
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }


    public function actionShow($id){
        $this->layout = 'auth';
        // $request = Yii::$app->request;
        // $id = $request->get('id');
        $video = $this->findVideo($id);
        $videoView = new VideoView();
        $videoView->video_id = $id;
        $videoView->user_id = Yii::$app->user->id;
        $videoView->created_at = time();
        $videoView->save();

        $similarVideos = Video::find()
        ->published()
        ->andWhere(["NOT", ["video_id" => $id]])
        ->byKeyword($video->title)
        ->limit(10)->all();

        return $this->render('show', [
            'model' => $video,
            'similarVideos' => $similarVideos
        ]);
    }

    public function actionLike($id){
        // $request = Yii::$app->request;
        // $id = $request->get('id');
        $user_id = Yii::$app->user->id;
        $video = $this->findVideo($id);

        $videoLikeDislike = VideoLike::find()->userIdvideoId($user_id, $id)->one();

        $type = VideoLike::TYPE_LIKE;
        
        if(!$videoLikeDislike){
            $this->saveLikeDislike($id, $user_id, $type);
        }else if($videoLikeDislike->type === VideoLike::TYPE_LIKE){
            $videoLikeDislike->delete();
        }else {
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $user_id, $type);
        }

        return $this->renderAjax('_buttons', [
            "model" => $video
        ]);
        
    }

    public function actionDislike($id){
        $user_id = Yii::$app->user->id;
        $video = $this->findVideo($id);

        $videoLikeDislike = VideoLike::find()->userIdvideoId($user_id, $id)->one();

        $type = VideoLike::TYPE_DISLIKE;
        
        if(!$videoLikeDislike){
            $this->saveLikeDislike($id, $user_id, $type);
        }else if($videoLikeDislike->type === VideoLike::TYPE_DISLIKE){
            $videoLikeDislike->delete();
        }else {
            $videoLikeDislike->delete();
            $this->saveLikeDislike($id, $user_id, $type);
        }

        return $this->renderAjax('_buttons', [
            "model" => $video
        ]);
    }

    
    protected function findVideo($id){
       $video = Video::findOne($id);
       if(!$video) {
            throw new NotFoundHttpException("Video does not exists");
       }
       return $video;
    }

    protected function saveLikeDislike($videoId, $userId, $type){
            $videoLikeDislike = new VideoLike();
            $videoLikeDislike->video_id = $videoId;
            $videoLikeDislike->user_id = $userId;
            $videoLikeDislike->created_at = time();
            $videoLikeDislike->type = $type;
            $videoLikeDislike->save();
    }


    public function actionSearch($keyword){

        $query = Video::find()
        ->published()
        ->latest();
        
        if($keyword){
            $query = $query
            ->byKeyword($keyword)
            ->orderBy("MATCH(title, description, tags)
            AGAINST ('$keyword') DESC");
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render("search", [
            "dataProvider" => $dataProvider
        ]);
    }

    public function actionHistory(){
        $query = Video::find()
        ->alias('v')
        ->innerJoin("(SELECT video_id, MAX(created_at) as max_date FROM video_view
                       WHERE user_id = :userId
                       GROUP BY video_id) vv", 'vv.video_id = v.video_id', [
                           "userId" => Yii::$app->user->id
                       ])
        ->orderBy("vv.max_date DESC");
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render("history", [
            "dataProvider" => $dataProvider
        ]);
    }
}