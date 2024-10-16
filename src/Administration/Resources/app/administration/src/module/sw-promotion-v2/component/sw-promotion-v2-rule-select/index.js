import template from './sw-promotion-v2-rule-select.html.twig';
import './sw-promotion-v2-rule-select.scss';

const { Component } = Shopware;

Component.register('sw-promotion-v2-rule-select', {
    template,

    model: {
        prop: 'collection',
        event: 'change'
    },

    inject: [
        'repositoryFactory'
    ],

    props: {
        collection: {
            type: Array,
            required: false,
            default: null
        },

        ruleScope: {
            type: Array,
            required: false,
            default: null
        }
    },

    data() {
        return {
            showRuleModal: false
        };
    },

    methods: {
        onChange(collection) {
            this.$emit('change', collection);
        },

        onSaveRule(ruleId) {
            const ruleRepository = this.repositoryFactory.create(
                this.collection.entity,
                this.collection.source
            );

            ruleRepository.assign(ruleId, this.collection.context).then(() => {
                ruleRepository.search(this.collection.criteria, this.collection.context).then((searchResult) => {
                    this.$emit('change', searchResult);
                    this.$refs.ruleSelect.sendSearchRequest();
                });
            });
        }
    }
});
