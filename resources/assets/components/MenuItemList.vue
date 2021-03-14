<template>

    <draggable
        :list="items"
        item-key="itemListId"
        :class="menuListClass"
        :group="group"
        tag="transition-group"
        :component-data="{
          tag: 'div',
          type: 'transition-group',
        }"

        v-bind="dragOptions"
        handle=".sort-handle"
        ghost-class="ghost"
    >
        <template #item="{ element,index }">
            <div :class="menuItemWrapperClass">
                <menu-item
                    v-model:title.lazy.trim="element.title"
                    v-model:slug.lazy.trim="element.slug"
                    v-model:item-list-id="element.itemListId"
                    :index="index"
                    :hide-view-children-btn="hideViewChildrenBtn"
                    :sort-handle="sortHandle"
                    v-on:delete-item="deleteMenuItem(index)">
                </menu-item>
            </div>
        </template>
    </draggable>
</template>

<script>
import draggable from "vuedraggable";
import MenuItem from "./MenuItem";

export default {
    name: "MenuItemList",
    components: {MenuItem, draggable},
    data() {
        return {
            dragOptions:{
                animation: 200,
                disabled: false,
                ghostClass: "ghost"
            }
        }
    },
    props: {
        items: Array,
        group:String,
        hideViewChildrenBtn: Boolean,
        sortHandle: String,
        menuListClass: String,
        menuItemWrapperClass: String
    },
    methods: {
        deleteMenuItem(index) {
            this.items.splice(index, 1);
        }
    }
}
</script>

<style scoped lang="scss">
.ghost {
    opacity: 0.5;
    background: #c8ebfb;
}
.flip-list-move {
    transition: transform 0.5s;
}
.no-move {
    transition: transform 0s;
}
</style>
