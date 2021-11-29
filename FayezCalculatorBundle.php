<?php

namespace Fayez\CalculatorBundle;

use Fayez\CalculatorBundle\DependencyInjection\FayezCalculatorExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FayezCalculatorBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new FayezCalculatorExtension();
        }

        return $this->extension;
    }
}
