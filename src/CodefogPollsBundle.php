<?php

namespace Codefog\PollsBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CodefogPollsBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}
