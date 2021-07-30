import {createApp} from 'vue';
import {createStore, createLogger} from 'vuex'

/**
 * Vuex Store Setup
 * @type {Store<{menuItemCount: number, selectedTopLevelMenuItemListId: null, columnCount: number}>}
 */
const menuStore = createStore({
    state() {
        return {
            selectedTopLevelMenuItemListId: null,
            menuItemCount: 0,
            columnCount: 0
        }
    },
    mutations: {
        setTopLevelMenuItemListId(state, index) {
            state.selectedTopLevelMenuItemListId = index;
        },
        incrementMenuItemCount(state) {
            state.menuItemCount++;
        },
        decrementMenuItemCount(state) {
            state.menuItemCount--;
        },
        incrementMenuColumnCount(state) {
            state.columnCount++;
        },
        decrementMenuColumnCount(state) {
            state.columnCount--;
        }
    },
    plugins: process.env.NODE_ENV !== 'production'
        ? [createLogger()]
        : []
})

//Import our main app component
import MegaMenuApp from '../components/MegaMenuApp.vue'

//Grab saved menu json from hidden input.
const savedMenuJson = document.getElementById('original_menu_json').value;

let menuArray = [];
if (savedMenuJson !== undefined && savedMenuJson !== null && savedMenuJson.length > 0) {
    menuArray = JSON.parse(savedMenuJson);
}

//State mixin


const app = createApp(MegaMenuApp, {initialMenuArray: menuArray});
app.use(menuStore)
app.mount("#mega-menu-app")
