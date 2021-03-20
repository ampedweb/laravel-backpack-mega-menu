import {shallowMount, mount} from '@vue/test-utils';
import MenuItem from '../resources/components/MenuItem.vue';

describe('MenuItem Tests', () => {

    const wrapper = mount(MenuItem, {
            propsData: {
                title: 'Menu Item Title',
                slug: 'menu-item-slug',
                itemListId:1
            }
        }
    );

    test('Mount view component', () => {
        expect(wrapper.html()).toMatchSnapshot()
    });

    test('Invalid title validation shown', async () => {

        await wrapper.get('[data-test="title-input"]').setValue("")

        expect(wrapper.get('[data-test="title-invalid-feedback"]').isVisible()).toBe(true)

    });

    test('Invalid slug validation shown', async () => {

        await wrapper.get('[data-test="slug-input"]').setValue("")

        expect(wrapper.get('[data-test="slug-invalid-feedback"]').isVisible()).toBe(true)

    });
});
