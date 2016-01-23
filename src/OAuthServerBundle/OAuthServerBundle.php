<?php

namespace OAuthServerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OAuthServerBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'FOSOAuthServerBundle';
    }
}
