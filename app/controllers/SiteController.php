<?php
    namespace app\controllers;

    use dergus\fw\BaseController;
    use dergus\fw\FW;

    use app\models\Review;



    /**
    *
    */
    class SiteController extends BaseController
    {
        public $title='reviews';

        public function actionReviews()
        {

            $reviews=Review::getAll();

            return $this->render('reviews',compact('reviews'));
        }

        public function actionAddReview()
        {
            $response=[
                'status'=>0,
                'errors'=>[]
            ];
            if(isset($_POST['review'])){
                $model = new Review;
                $model->setAttributes($_POST['review']);
                if($model->validate()  && $model->save()){
                    $response['status']=1;
                }else{
                    $response['errors']=$model->errors;
                }
                return json_encode($response);
            }
        }

        public function actionError()
        {
            return "11error";
        }


    }