<?php
namespace app\modules\admin\controllers;

use yii\web\Controller;
use app\modules\admin\models\Types;
use Yii;
use yii\base\Exception;
use app\components\PostValidationTrait;
/**
 * Dashboard controller for the `modules` admin
 */
class TypesController extends Controller
{
    use PostValidationTrait;

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
        $model = new Types();
        $dataProvider = $model->getDataProvider();
        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Creates a new Types model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Types();
        $success = true;

        $model->load(Yii::$app->request->post()) &&  $this->validateTypePost($model,'type-create'); // load post and validate it via ajax

        try{
            $model->save();
            $message = 'Type Successfully Added';
        } catch (Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        echo json_encode(['message'=>$message,'success'=>$success,'table_id'=>'tbl_types']); exit();
    }

    /**
     * Updates an existing Types model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return true;
        }

        return $this->renderPartial('update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing Types model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Types model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Types the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Types::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

