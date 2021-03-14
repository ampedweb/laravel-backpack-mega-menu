import {createApp} from 'vue';
import {createStore, createLogger} from 'vuex'

const menuStore = createStore({
    state() {
        return {
            selectedTopLevelMenuItemListId: null
        }
    },
    mutations: {

        setTopLevelMenuItemListId(state, index) {
            state.selectedTopLevelMenuItemListId = index;
        }
    },
    plugins: process.env.NODE_ENV !== 'production'
        ? [createLogger()]
        : []
})


import MegaMenuApp from './components/MegaMenuApp.vue'


const savedMenuJson = document.getElementById('original_menu_json').value;

let menuArray = [];
if (savedMenuJson !== undefined && savedMenuJson !== null && savedMenuJson.length > 0) {
    menuArray = JSON.parse(savedMenuJson);
}

const app = createApp(MegaMenuApp, {initialMenuArray: menuArray});
app.use(menuStore)
app.mount("#mega-menu-app")
