<?php

namespace Tumic\Modules\NotAllowed;

use Tumic\Modules\Base\BaseController;

class NotAllowedController extends BaseController
{
    public function index()
    {
        $this->allowOnly("logged");
        parent::render(__DIR__ . '/notAllowed.html.php');
    }
}
