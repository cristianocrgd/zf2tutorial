<?php
/**
 * Created by PhpStorm.
 * User: Univicosa
 * Date: 23/09/2015
 * Time: 11:52
 */

<?php

namespace Contato\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Http\Request;

class MenuAtivo extends AbstractHelper
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke($url_menu = '')
    {
        return $this->request->getUri()->getPath() == $url_menu ? 'class="active"' : '';
    }
}