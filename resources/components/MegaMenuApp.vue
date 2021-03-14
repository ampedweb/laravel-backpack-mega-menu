<template>
    <div>
        <input type="hidden" name="menu_json" :value="menuToJson">
        <div class="row mb-4">
            <div class="col-md-6">
                <h3>Menu Builder</h3>
            </div>
            <div class="col-md-6 text-right">
                <button type="button" class="btn btn-primary btn-sm" @click="addToplevelMenuItem">Add Top Level Menu
                    Item <i class="la la-plus"></i></button>
            </div>

        </div>




        <div v-if="menu.length !== undefined && menu.length > 0">
            <div class="form-row">
                <div class="col-12">
                    <h4 class="mb-3">Top Level Menu Items</h4>
                </div>
            </div>
            <menu-item-list group="topLevelMenuItems" menu-list-class="form-row" menu-item-wrapper-class="col" v-model:items="menu"
                            sort-handle="horizontal"></menu-item-list>

        </div>

        <div v-show="menu.length === undefined || menu.length === 0" class="alert alert-primary text-center" role="alert">
            Create your first top level menu item using the "Add Top Level Menu Item" button.
        </div>


        <div v-if="selectedTopLevelMenuItemListId !== null && selectedTopLevelMenuItemListId >= 0 && menu.length !== undefined && menu.length > 0">
            <div class="form-row">
                <div class="col-md-8">
                    <h3>Top Level Menu Item Column</h3>
                </div>
                <div class="col-md-4 text-right">
                    <button type="button" class="btn btn-primary btn-sm"
                            @click="addMenuItemColumn(selectedTopLevelMenuItemListId)">
                        Add Column
                        <i class="la la-plus"></i>
                    </button>
                </div>
            </div>
            <div v-if="topLevelMenuItemHasColumns(selectedTopLevelMenuItemListId)" class="form-row">
                <div v-for="(column,index) in selectedTopLevelMenuColumnsArray" class="col menu-column">
                    <div class="card bg-light">
                        <div class="card-body px-0">
                            <menu-column v-model:items="column.items" v-model:title="column.title"
                                         v-on:delete-column="deleteMenuColumn(index)"></menu-column>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MenuItemList from "./MenuItemList";
import MenuColumn from "./MenuColumn";

export default {
    name: "MegaMenuApp",
    components: {MenuColumn, MenuItemList},
    props: {
        initialMenuArray: Array
    },
    mounted() {
        if (this.initialMenuArray !== undefined && this.initialMenuArray !== null) {
            this.menu = this.initialMenuArray;
        }
    },
    data() {
        return {
            menu: []
        }
    },
    computed: {

        menuToJson() {
            return JSON.stringify(this.menu);
        },

        selectedTopLevelMenuColumnsArray() {

            const topLevelColumnMenuIndex = this.getTopLevelMenuItemColumnsByListItemId(this.selectedTopLevelMenuItemListId);
            return this.menu[topLevelColumnMenuIndex].columns;
        },

        selectedTopLevelMenuItemListId() {
            return this.$store.state.selectedTopLevelMenuItemListId;
        }
    },
    methods: {
        topLevelMenuItemHasColumns(itemListId) {

            const index = this.getTopLevelMenuItemColumnsByListItemId(itemListId);

            if(index < 0 || this.menu[index] === undefined) {
                return false;
            }

            return this.menu[index].columns !== undefined
                && this.menu[index].columns !== null
                && this.menu[index].columns.length > 0;
        },
        getTopLevelMenuItemColumnsByListItemId(itemListId) {

            const menuItemFilter = menuItem => menuItem.itemListId === itemListId;

            return this.menu.findIndex(menuItemFilter);

        },
        //Add new blank top level menu item.
        addToplevelMenuItem() {

            const itemListId = this.createUniqueId();

            const item = {
                title: '',
                slug: '',
                itemListId: itemListId,
                columns: []
            }

            this.menu.push(item);

        },
        createUniqueId() {

            const items = this.menu;

            let maxId = 0;
            items.forEach((item,index) => {
                if(item.itemListId !== undefined && parseInt(item.itemListId) > maxId) {
                    maxId = parseInt(item.itemListId)
                }
            });

            return (maxId + 1);
        },
        addMenuItemColumn(itemListId) {

            const index = this.getTopLevelMenuItemColumnsByListItemId(itemListId)

            const item = {
                title: '',
                items: []
            }

            //Make sure the index definitely exists
            if(this.menu[index] === undefined) {
                return false;
            }

            //Make sure the columns array is defined
            if (this.menu[index].columns === undefined) {
                this.menu[index].columns = [];
            }

            //Push the item onto the columns item list
            this.menu[index].columns.push(item);

        },
        deleteMenuColumn(index) {
            if (confirm("Are you sure you want to delete this column? All menu items inside will be deleted.")) {
                this.selectedTopLevelMenuColumnsArray.splice(index, 1);
            }
        }
    }
}
</script>

<style scoped lang="scss">

.menu-column {
    min-width: 20%;
}

.btn {
    &:focus {
        box-shadow: none;
    }
}
</style>
