<?php declare(strict_types=1);

namespace AreanetDefaultProductLayout\Core\Content\Product\Subscriber;

use Shopware\Core\Content\Product\AbstractIsNewDetector;
use Shopware\Core\Content\Product\AbstractProductMaxPurchaseCalculator;
use Shopware\Core\Content\Product\AbstractProductVariationBuilder;
use Shopware\Core\Content\Product\AbstractPropertyGroupSorter;
use Shopware\Core\Content\Product\ProductDefinition;
use Shopware\Core\Content\Product\SalesChannel\Price\AbstractProductPriceCalculator;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\Event\EntityLoadedEvent;
use Shopware\Core\Framework\Feature;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Shopware\Core\Content\Product\ProductEvents;

class AreanetProductSubscriber implements EventSubscriberInterface
{
    private SystemConfigService $systemConfigService;

    public function __construct(
        SystemConfigService $systemConfigService
    ) {
        $this->systemConfigService = $systemConfigService;
    }

    public static function getSubscribedEvents(): array
    {

        return [
            ProductEvents::PRODUCT_LOADED_EVENT => 'loaded',
        ];
    }

    public function loaded(EntityLoadedEvent $event)
    {
        $salesChannelId  = $event->getContext()->getSource()->getSalesChannelId();

        foreach ($event->getEntities() as $product) {
            $this->setDefaultLayout($product, $salesChannelId);
        }
    }

    protected function setDefaultLayout(Entity $product, string $salesChannelId ){

        $systemDefaultCmsPageId = $this->systemConfigService->get(ProductDefinition::CONFIG_KEY_DEFAULT_CMS_PAGE_PRODUCT, $salesChannelId);
        if($product->has('cmsPageId') != $systemDefaultCmsPageId){
            return;
        }

        $cmsPageId  = $this->systemConfigService->get('AreanetDefaultProductLayout.config.layout', $salesChannelId);
        if(!$cmsPageId){
            $this->systemConfigService->get(ProductDefinition::CONFIG_KEY_DEFAULT_CMS_PAGE_PRODUCT, $salesChannelId);
        }

        $product->assign(['cmsPageId' => $cmsPageId]);
    }
}
