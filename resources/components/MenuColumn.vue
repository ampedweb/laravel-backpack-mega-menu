<template>
    <div>
        <div class="form-row px-3">
            <div class="col-md-10 mb-3">
                <input type="text" class="form-control form-control-sm"
                       :class="{'is-invalid':isTitleInvalid && showValidation}" placeholder="Column Title"
                       :value="title" @input="$emit('update:title', $event.target.value); revealValidation()">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-transparent p-0 btn-sm text-danger delete-btn"
                        @click="$emit('delete-column');"><i class="las la-trash-alt"></i></button>
            </div>
        </div>

        <menu-item-list menu-item-wrapper-class="col-12" group="columnMenuItems" v-model:items="items"
                        :hide-view-children-btn="true" sort-handle="alldirections"></menu-item-list>

        <div class="col-12">
            <button class="btn-primary btn btn-sm" type="button" @click="addMenuItem">Add Menu Item <i
                class="la la-plus"></i></button>
        </div>
    </div>
</template>

<script>
import MenuItemList from "./MenuItemList";
import MenuItemMixin from "./mixins/MenuItemMixin";

export default {
    name: "MenuColumn",
    mixins: [MenuItemMixin],
    components: {MenuItemList},
    data() {
        return {
            showValidation: false,
        }
    },
    mounted() {
        this.incrementMenuColumnCount()
    },
    unmounted() {
        this.decrementMenuColumnCount()
    },
    props: {
        title: String,
        items: Array
    },
    computed: {
        isTitleInvalid() {
            return this.title.length === 0;
        },
    },
    methods: {
        revealValidation() {
            this.showValidation = true;
        },
        incrementMenuColumnCount() {
            this.$store.commit('incrementMenuColumnCount');
        },
        decrementMenuColumnCount() {
            this.$store.commit('decrementMenuColumnCount');
        },
        addMenuItem() {
            this.items.push(this.createBlankMenuItem(false));
        }
    }

}
</script>

<style scoped lang="scss">


.btn {
    font-size: .75rem;

    &.delete-btn {
        font-size: 1.6rem;
    }

    &:focus {
        box-shadow: none;
    }
}
</style>
