import { shallowMount } from '@vue/test-utils';
import 'src/module/sw-extension/component/sw-extension-card-base';

function createWrapper(propsData = {}) {
    return shallowMount(Shopware.Component.build('sw-extension-card-base'), {
        propsData: {
            ...propsData
        },
        mocks: {
            $tc: v => v
        },
        stubs: {
            'sw-meteor-card': true,
            'sw-switch-field': true,
            'sw-context-button': true,
            'sw-context-menu': true,
            'sw-context-menu-item': true
        },
        provide: {
            shopwareExtensionService: {
                canBeOpened: () => true
            },
            extensionStoreActionService: {}
        }
    });
}

describe('src/module/sw-extension/component/sw-extension-card-base', () => {
    /** @type Wrapper */
    let wrapper;

    beforeAll(() => {
        Shopware.Context.api.assetsPath = '';
        Shopware.Utils.debug.warn = () => {};
    });

    beforeEach(async () => {
        wrapper = await createWrapper();
    });

    afterEach(async () => {
        if (wrapper) await wrapper.destroy();
    });

    it('should be a Vue.JS component', async () => {
        expect(wrapper.vm).toBeTruthy();
    });

    it('should contain the correct computed values', async () => {
        wrapper = await createWrapper({
            license: {
                licensedExtension: {}
            }
        });
    });

    it('should show the short description when it exists', async () => {
        wrapper = await createWrapper({
            license: {
                licensedExtension: {
                    shortDescription: 'My short description',
                    description: 'My long description'
                }
            }
        });

        expect(wrapper.vm.description).toEqual('My short description');
    });

    it('should show the long description as fallback when short does not exists', async () => {
        wrapper = await createWrapper({
            license: {
                licensedExtension: {
                    shortDescription: '',
                    description: 'My long description'
                }
            }
        });

        expect(wrapper.vm.description).toEqual('My long description');
    });

    it('should show the correct image (icon)', async () => {
        wrapper = await createWrapper({
            license: {
                licensedExtension: {
                    icon: 'my-icon'
                }
            }
        });

        expect(wrapper.vm.image).toEqual('my-icon');
    });

    it('should show the correct image (iconRaw)', async () => {
        const base64Example = 'z87hufieajh38haefwa9hefjio';

        wrapper = await createWrapper({
            license: {
                licensedExtension: {
                    iconRaw: base64Example
                }
            }
        });

        expect(wrapper.vm.image).toEqual(`data:image/png;base64, ${base64Example}`);
    });

    it('should show the correct image (default theme asset)', async () => {
        wrapper = await createWrapper({
            license: {
                licensedExtension: {}
            }
        });

        expect(wrapper.vm.image).toEqual('administration/static/img/theme/default_theme_preview.jpg');
    });

    it('should be installed', async () => {
        wrapper = await createWrapper({
            extension: {
                installedAt: '845618651'
            }
        });

        expect(wrapper.vm.isInstalled).toEqual(true);
    });

    it('should not be installed', async () => {
        wrapper = await createWrapper();

        expect(wrapper.vm.isInstalled).toEqual(false);
    });

    it('should show the label', async () => {
        wrapper = await createWrapper({
            license: {
                licensedExtension: {
                    label: 'My mega plugin'
                }
            }
        });

        expect(wrapper.vm.label).toEqual('My mega plugin');
    });
});
