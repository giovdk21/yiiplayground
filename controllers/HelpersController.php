<?php

namespace app\controllers;

use app\components\BaseController;


class HelpersController extends BaseController
{

    public function actionUrl() {

        $this->actionParams = ['breadcrumbs'=>'aa'];

        return $this->render('url', [
            'breadcrumbs' => [['label' => 'Sample Post', 'url' => ['post/edit', 'id' => 1]]]
            ]);
    }


    public function actionHtml() {
        return $this->render('html');
    }


}
