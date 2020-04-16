<?php

namespace Tumic\Modules\NotFound;

use Tumic\Lib\Singleton;
use Tumic\Modules\Base\BaseController;

class NotFoundController extends BaseController
{
    public function index()
    {
        $this->allowOnly("all");
        http_response_code(404);
        parent::render(__DIR__ . '/notFound.html.php');
    }
}
