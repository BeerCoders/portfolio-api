<?php

namespace DocBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DocBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'NelmioApiDocBundle';
    }
}
