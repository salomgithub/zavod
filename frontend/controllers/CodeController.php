<?php

namespace frontend\controllers;

use frontend\models\CodeForm;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Yii;
use frontend\models\Code;
use frontend\models\CodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CodeController implements the CRUD actions for Code model.
 */
class CodeController extends Controller
{
    public $layout = 'admin';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Code models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Code model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Code model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Code();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionImport()
    {
        $model = new CodeForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                $excelData = $model->getArrayDataFromExcel();
                // Fayldagi ma'lumotlarni ekranga chiqarish
                echo "<pre>";
                unset($excelData[1]);
//                print_r($excelData);

                foreach ($excelData as $excelDatum) {
                    $mfo = (int) $excelDatum['A'];
                    $tovar_id = (int) $excelDatum['B'];
                    $codeValue = "" . $excelDatum['C'] . "";  // Use a different variable name to avoid conflicts
                    $price = (int) $excelDatum['D'];

                    $code = new Code();
                    $code->mfo = $mfo;
                    $code->tovar_id = $tovar_id;
                    $code->code = $codeValue;  // Use the new variable here
                    $code->price = $price;

                    if ($code->save()) {
                        // Successfully saved, continue with the next iteration
                        continue;
                    } else {
                        // Error occurred while saving, print the error details and exit
                        $error = $code->errors;
                            echo '<script>alert("Faylda Xatolik ");</script>';
                            var_dump($code->errors);
                        die();
                    }
                }
                echo '<script>alert("Saqlandi ");</script>';


            }
            $uploadsDirectory = 'uploads/';

            $files = glob($uploadsDirectory . '*');
            foreach ($files as $file) {
                if (is_file($file))
                    unlink($file);
            }
             $this->redirect("https://mavrid.ingo.uz/index.php?r=code%2Findex");
        }

        return $this->render('import', ['model' => $model]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Code model.
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
     * Finds the Code model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Code the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Code::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
