const { Component } = Shopware;
const { Criteria } = Shopware.Data;

Component.extend('layout-state-select', 'sw-entity-single-select', {
    props: {
        criteria: {
            type: Object,
            required: false,
            default() {
                const criteria = new Criteria(1, this.resultLimit);
                criteria.addFilter(Criteria.equals('type', 'product_detail'));
                return criteria;
            }
        },
    }
});
