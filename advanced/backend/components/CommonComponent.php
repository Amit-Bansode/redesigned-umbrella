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

class CommonComponent extends Component {

    //put your code here

    public function createUniqueJobId($intJobType, $intId = null) {

        if (TRUE == is_null($intId)) {
            $objJobPost = \backend\models\JobPosts::find()->orderBy(['id' => SORT_DESC])->one();
            $intId = (true == is_object($objJobPost)) ? $objJobPost->id + 1 : 1;
        }

        return 'GOVT' . str_pad($intId, 5, 0, STR_PAD_LEFT);
    }
    
    public function convertDateFormat( $strDate, $strDateFormat = 'Y-m-d H:i:s' ) {
        
        if( FALSE == strlen($strDate) ) {
            return NULL;
        }
        return date( $strDateFormat, strtotime( $strDate ) );
        
    }

}
