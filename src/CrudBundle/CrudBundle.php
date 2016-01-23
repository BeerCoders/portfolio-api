<?php

namespace CrudBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CrudBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'VardiusCrudBundle';
    }
}
