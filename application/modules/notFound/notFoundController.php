<?php

namespace Tumic\Modules\NotFound;

use Tumic\Lib\Singleton;
use Tumic\Modules\Base\BaseController;

class NotFoundController extends BaseController
{
    public function index()
    {
        parent::render(__DIR__ . '/notFound.html.php');
    }
}
