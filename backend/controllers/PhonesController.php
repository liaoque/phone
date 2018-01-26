<?php

namespace backend\controllers;

use backend\models\PhoneUsers;
use backend\models\TagsGroup;
use Yii;
use backend\models\Phones;
use backend\models\PhonesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PhonesController implements the CRUD actions for Phones model.
 */
class PhonesController extends Controller
{
    public function actions()
    {
        $actions = parent::actions();
        $actions['get-region'] = [
            'class' => \chenkby\region\RegionAction::className(),
            'model' => \backend\models\Areas::className()
        ];
        return $actions;
    }


    /**
     * @inheritdoc
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
     * Lists all Phones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhonesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Phones model.
     * @param string $id
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
     * Creates a new Phones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Phones();
        $data = Yii::$app->request->post();
        if ($model->load($data)  && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $phoneUsersModel = new PhoneUsers();
        return $this->render('create', [
            'model' => $model,
            'phoneUsersModel' => $phoneUsersModel
        ]);
    }

    public function actionCreateAll()
    {
        $model = new Phones();
        if (Yii::$app->request->getIsPost()) {
            $data = Yii::$app->request->post();
            unset($data[1]['phoneFile']);
            if ($model->load($data) && $model->validate()) {
                $model->setPhoneFile(UploadedFile::getInstance($model, 'phoneFile'));
                if (!$model->upload()) {
                    $model->addError($model, 'phoneFile', '文件上传失败');
                    return $this->goBack();
                }
                $phoneList = Phones::createMorePhone($model);
                $session = Yii::$app->session;
                $session->setFlash(Phones::CREATE_MORE_SUCCESS, $phoneList);
                return $this->redirect('create-success');
            }
        }
        $phoneUsersModel = new PhoneUsers();
        return $this->render('create-all', [
            'model' => $model,
            'phoneUsersModel' => $phoneUsersModel
        ]);
    }

    public function actionCreateSuccess()
    {
        $session = Yii::$app->session;
        $result = $session->hasFlash(Phones::CREATE_MORE_SUCCESS);
        if ($result) {
            $phoneList = $session->getFlash(Phones::CREATE_MORE_SUCCESS);
            return $this->render('create-all-success', [
                'dataProvider' => $phoneList,
            ]);
        } else {
            return $this->redirect('index');
        }
    }


    /**
     * Updates an existing Phones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $model->tags = $model->tagsGroup->tags;
        return $this->render('update', [
            'model' => $model,
            'phoneUsersModel' => $model->phoneUser
        ]);
    }

    /**
     * Deletes an existing Phones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Phones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Phones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Phones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
