<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CommonComponents
 *
 * @author Rakesh
 */

namespace backend\components;

use yii\base\Component;
use yii;
class CommonComponent extends Component {

    //put your code here

    public function init() {
        
        Yii::$app->view->params['arrmixReturnNotification'] = \app\models\Notifications::fetchNotifications();
        parent::init();
    }
    
    public function createUniqueJobId($intJobType, $intId = null) {

        if (TRUE == is_null($intId)) {
            $objJobPost = \backend\models\JobPosts::find()->orderBy(['id' => SORT_DESC])->one();
            $intId = (true == is_object($objJobPost)) ? $objJobPost->id + 1 : 1;
        }

        return 'GOVT' . str_pad($intId, 5, 0, STR_PAD_LEFT);
    }

    public function convertDateFormat($strDate, $strDateFormat = 'Y-m-d H:i:s') {

        if (FALSE == strlen($strDate)) {
            return NULL;
        }
        return date($strDateFormat, strtotime($strDate));
    }

    public function convertBooleanValue($boolValue) {
        return ( true == $boolValue ) ? 'True' : 'False';
    }

    public function createdLog($strTableName, $arrStrAttributes = [], $intUserId) {
        $objChangeLogModel = new \backend\models\ChangeLog();
        $objChangeLogModel->created_on = date('Y-m-d H:i:s');
        $objChangeLogModel->created_by = $intUserId;
        $objChangeLogModel->table_name = $strTableName;
        $objChangeLogModel->data = serialize($arrStrAttributes);

        $objChangeLogModel->save();
    }

    public function getuPloadedFiles($strCustomerUniqueId) {
        $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        $root .= 'redesigned-umbrella/';

        $arrDocumentDetails = (new \yii\db\Query())
                ->select(['*'])
                ->from('documents_details')
                ->where(['customer_id' => $strCustomerUniqueId])
                ->all();

        foreach ($arrDocumentDetails AS $intKey => $arrdocumentDetail) {
            $arrDocumentDetails[$intKey]['document_link'] = $root . $arrdocumentDetail['document_link'];
        }

        return $arrDocumentDetails;
    }

}
