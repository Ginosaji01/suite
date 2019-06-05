<?php

/**
 * This file is part of the Spryker Suite.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Development\Communication\Console;

use Spryker\Zed\Development\Communication\Console\CodeTestConsole;

class FunctionalCodeTestConsole extends CodeTestConsole
{
    public const COMMAND_NAME = 'code:test:functional';

    protected const CODECEPT_CONFIG_FILE_NAME = 'codeception.functional.yml';
}
