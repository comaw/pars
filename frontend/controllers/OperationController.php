<?php

namespace frontend\controllers;

use app\models\ParsSettings;
use Yii;
use app\models\Operation;
use app\models\OperationSearch;
use frontend\ext\BaseController;
use yii\web\NotFoundHttpException;

/**
 * OperationController implements the CRUD actions for Operation model.
 */
class OperationController extends BaseController
{

    /**
     * Lists all Operation models.
     * @return mixed
     */
    public function actionIndex($pars = 0)
    {
        $searchModel = new OperationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $pars);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pars' => (int)$pars,
        ]);
    }

    /**
     * Displays a single Operation model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCsv($pars = 0)
    {
        if($pars){
            $model = Operation::find()->where("pars = :pars", [':pars' => (int)$pars])->orderBy("url asc")->all();
        }else{
            $model = Operation::find()->orderBy("url asc")->all();
        }
        include(Yii::getAlias('@vendor/phpoffice/phpexcel/Classes/PHPExcel.php'));
        include(Yii::getAlias('@vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php'));
        $objPHPExcel = new \PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Php Shaman")
            ->setLastModifiedBy("Php Shaman")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Data for yelp parsing")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Data for yelp parsing");

        // Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'name')
            ->setCellValue('B1', 'categories')
            ->setCellValue('C1', 'phone')
            ->setCellValue('D1', 'state')
            ->setCellValue('E1', 'city')
            ->setCellValue('F1', 'address')
            ->setCellValue('G1', 'postal')
            ->setCellValue('H1', 'site')
            ->setCellValue('I1', 'description');

        foreach($model AS $k => $o){
            $cat = [];
            foreach($o->categories AS $c){
                $cat[] = $c->name;
            }
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.($k + 2), $o->name)
                ->setCellValue('B'.($k + 2), join(' | ', $cat))
                ->setCellValue('C'.($k + 2), $o->phone)
                ->setCellValue('D'.($k + 2), ParsSettings::getState($o->state))
                ->setCellValue('E'.($k + 2), $o->city)
                ->setCellValue('F'.($k + 2), $o->address)
                ->setCellValue('G'.($k + 2), $o->postal)
                ->setCellValue('H'.($k + 2), $o->site)
                ->setCellValue('I'.($k + 2), $o->description);
        }

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="pars.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
        header ('Cache-Control: cache, must-revalidate');
        header ('Pragma: public');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
    /**
     * Updates an existing Operation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Operation model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Operation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Operation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Operation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }
    }
}
