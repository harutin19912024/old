<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
use yii\base\Exception;
use app\components\PostValidationTrait;
use app\components\FileUploadTrait;
use app\modules\admin\models\Vendors;

class VendorsController extends Controller
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
        $model = new Vendors();
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
        $model = new Vendors();
        $success = true;
        $message = '';

        $model->prepareLogoFile();

        $model->load(Yii::$app->request->post()) &&  $this->validateTypePost($model,'vendor-create'); // load post and validate it via ajax

        try{
            if($model->logoFile instanceof UploadedFile) {
                $model->logo = $this->uploadFile($model->logoFile, 'vendors');
            }
            if($model->validate() && $model->save()) {
                $message = 'Type Successfully Added';
            }
        } catch (Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        echo json_encode(['message'=>$message,'success'=>$success,'table_id'=>'tbl_vendors']); exit();
    }

}

