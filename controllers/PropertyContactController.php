<?php

class PropertyContactController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'roles' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new PropertyContact;
        $property_id = Tools::getValue('propertyId');

// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['PropertyContact'])) {
            $model->attributes = $_POST['PropertyContact'];
            if ($model->save()) {

                $propDetail = Property::model()->findByPk($property_id);
                $token = Tools::getAdminToken();
                if ($propDetail->property_type == 'premium')
                    $propertyUrl = "property/view/id/" . $propDetail->id_property . "?token=" . $token;
                else if ($propDetail->property_type == 'general')
                    $propertyUrl = "property/view/general/id/" . $propDetail->id_property . "?token=" . $token;

                Yii::app()->user->setFlash('success', "Property Contact details saved successfully!<a href='" . Tools::getBaseUrl() . $propertyUrl . "' target='_blank'> Click here</a> to Preview");
                $this->redirect(array('update', 'id' => $model->od_property_contact));
            }
        }

        $this->render('create', array(
            'model' => $model,
            'id_property' => $property_id,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);
        $property_id = $model->id_property;
// Uncomment the following line if AJAX validation is needed
// $this->performAjaxValidation($model);

        if (isset($_POST['PropertyContact'])) {
            $model->attributes = $_POST['PropertyContact'];
            if ($model->save()) {
                $propDetail = Property::model()->findByPk($property_id);
                $token = Tools::getAdminToken();
                if ($propDetail->property_type == 'premium')
                    $propertyUrl = "property/view/id/" . $propDetail->id_property . "?token=" . $token;
                else if ($propDetail->property_type == 'general')
                    $propertyUrl = "property/view/general/id/" . $propDetail->id_property . "?token=" . $token;
                
                Yii::app()->user->setFlash('success', "Property Contact details saved successfully!<a href='" . Tools::getBaseUrl() . $propertyUrl . "' target='_blank'> Click here</a> to Preview");
                $this->redirect(array('update', 'id' => $model->id_property_contact));
            }
        }

        $this->render('update', array(
            'model' => $model,
            'id_property' => $property_id,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $propertyId = Tools::getValue('propertyId', '');
        if (isset($propertyId) && $propertyId != '') {
            $model = new PropertyContact;
            $isPropertyDetail = $model->findByAttributes(array('id_property' => $propertyId));
            if (isset($isPropertyDetail) && !is_null($isPropertyDetail))
                $this->redirect(array('update', 'id' => $isPropertyDetail->id_property_contact));

            else
                $this->redirect(array('create', 'propertyId' => $propertyId));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new PropertyContact('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['PropertyContact']))
            $model->attributes = $_GET['PropertyContact'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return PropertyContact the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = PropertyContact::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param PropertyContact $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'property-contact-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

