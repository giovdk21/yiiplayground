<?php
/**
 * BaseController used to extend other controllers
 * (similar to protected/components/Controller.php in Yii 1.x)
 */

namespace app\components;

use yii\web\Controller;

class BaseController extends Controller
{

    public $leftMenu = [
        ['label' => 'Home', 'url' => ['site/index']],
        [
            'label' => 'Basics',
            'items' => [
                ['label' => 'Path Aliases', 'url' => ['basics/aliases']],
//                ['label' => 'Events', 'url' => ['index']],
//                ['label' => 'Behaviors', 'url' => ['index']],
            ]
        ],
        [
            'label' => 'Helpers',
            'items' => [
                ['label' => 'Url', 'url' => ['helpers/url']],
                ['label' => 'Html', 'url' => ['helpers/html']],
            ]
        ],
				[
					'label' => 'Ajax request',
					'url' => ['ajax/index']
				],
    ];

} 