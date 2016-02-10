<?php

namespace Pyz\Zed\Installer\Business;

use Spryker\Zed\Installer\Business\InstallerFacade as SprykerInstallerFacade;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \Pyz\Zed\Installer\Business\InstallerBusinessFactory getFactory()
 */
class InstallerFacade extends SprykerInstallerFacade
{

    /**
     * @param OutputInterface $output
     *
     * @return \Spryker\Zed\Installer\Business\Model\AbstractInstaller[]
     */
    public function getIcecatDataInstallers(OutputInterface $output)
    {
        return $this->getFactory()->getIcecatDataInstallers($output);
    }

    /**
     * @return \Spryker\Zed\Installer\Business\Model\AbstractInstaller[]
     */
    public function getIcecatDataMappers()
    {
        return $this->getFactory()->getIcecatDataMappers();
    }

}
