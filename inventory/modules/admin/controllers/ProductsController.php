<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
use yii\base\Exception;
use app\components\PostValidationTrait;
use app\components\FileUploadTrait;
use app\modules\admin\models\Products;
use yii\web\UploadedFile;
/**
 * Dashboard controller for the `modules` admin
 */
class ProductsController extends Controller
{
    use PostValidationTrait,FileUploadTrait;
    public $layout = 'main';

    public function behaviors()
    {
        return [];
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = new Products();
        $dataProvider = $model->getDataProvider();
        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }


    /**
     * Creates a new Vendors model.
     * @throws Exception
     */
    public function actionCreate()
    {
        $model = new Products();
        $success = true;
        $message = '';

        $model->load(Yii::$app->request->post()) &&  $this->validateTypePost($model,'product-create'); // load post and validate it via ajax

        try{
            $imgFile = UploadedFile::getInstance($model, 'img_path');
            if($imgFile instanceof UploadedFile) {
                $model->img_path = $this->uploadFile($imgFile, 'products');
            }
            $model->tags = json_encode($model->tags);
            $model->release_date = date('Y-m-d',strtotime($model->release_date));
            if($model->validate() && $model->save()) {
                $message = 'Type Successfully Added';
            }
        } catch (Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        echo json_encode(['message'=>$message,'success'=>$success,'table_id'=>'tbl_products']); exit();
    }

}

