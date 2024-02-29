<?php declare(strict_types=1);

namespace AreanetDefaultProductLayout;

use Shopware\Core\Framework\Plugin;
use Shopware\Core\Framework\Plugin\Context\ActivateContext;
use Shopware\Core\Framework\Plugin\Context\DeactivateContext;
use Shopware\Core\Framework\Plugin\Context\InstallContext;
use Shopware\Core\Framework\Plugin\Context\UninstallContext;
use Shopware\Core\Framework\Plugin\Context\UpdateContext;
use AreanetDefaultPluginLayout\Service\CustomFieldsInstaller;

class AreanetDefaultProductLayout extends Plugin
{
    public function install(InstallContext $installContext): void
    {

    }

    public function uninstall(UninstallContext $uninstallContext): void
    {
        parent::uninstall($uninstallContext);

        if ($uninstallContext->keepUserData()) {
            return;
        }

    }

    public function activate(ActivateContext $activateContext): void
    {

    }

    public function deactivate(DeactivateContext $deactivateContext): void
    {

    }

    public function update(UpdateContext $updateContext): void
    {

    }

    public function postInstall(InstallContext $installContext): void
    {
    }

    public function postUpdate(UpdateContext $updateContext): void
    {
    }

}
