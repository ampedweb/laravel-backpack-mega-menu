import {shallowMount, mount} from '@vue/test-utils';
import MenuItem from '../resources/components/MenuItem.vue';

describe('MenuItem Tests', () => {

    const wrapper = mount(MenuItem, {
            propsData: {
                index:1,
                isVisible:true,
                title: 'Menu Item Title',
                slug: 'menu-item-slug',
                itemListId:4
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



    test('Delete button emits event with correct index', async () => {

        await wrapper.get('[data-test="delete-item-btn"]').trigger("click")

        expect(wrapper.emitted().deleteItem[0]).toEqual([1])

    });


});
