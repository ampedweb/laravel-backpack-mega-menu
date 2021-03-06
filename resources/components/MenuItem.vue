<template>
    <div class="card">
        <div class="card-body p-2">
            <div class="text-right">
                <div class="custom-control custom-switch mb-2">
                    <input type="checkbox" class="custom-control-input"
                           :id="'menu-item-' + uuid" :checked="isVisible"
                           @change="$emit('update:isVisible', $event.target.checked);"
                    >
                    <label class="custom-control-label" :for="'menu-item-' + uuid"><small
                        class="sr-only">Visible?</small></label>
                </div>
            </div>

            <input type="text" class="form-control form-control-sm" data-test="title-input"
                   :class="{'is-invalid':isTitleInvalid && showValidation}" placeholder="Title"
                   :value="title" @input="$emit('update:title', $event.target.value); revealValidation()">
            <span class="invalid-feedback" data-test="title-invalid-feedback">Please enter a valid title</span>

            <div class="form-group mb-0">
                <input type="text" class="form-control form-control-sm slug-input"
                       data-test="slug-input"
                       :class="{'is-invalid':isSlugInvalid && showValidation}" placeholder="Slug"
                       :value="slug" @input="$emit('update:slug', $event.target.value); revealValidation()">
                <span class="invalid-feedback" data-test="slug-invalid-feedback">Please enter a valid slug</span>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-primary btn-sm mt-2" type="button" data-test="view-children-btn"
                        v-if="hideViewChildrenBtn === false"
                        @click="setTopLevelMenuItemListId(id)">
                    View Children
                </button>
                <button class="btn btn-transparent btn-sm sort-handle text-primary p-0 mt-2 ml-auto mr-2" type="button">
                    <i class="las la-arrows-alt-h" v-show="sortHandle === 'horizontal'"></i>
                    <i class="las la-arrows-alt-v" v-show="sortHandle === 'vertical'"></i>
                    <i class="las la-arrows-alt" v-show="sortHandle === 'alldirections'"></i>
                </button>
                <button class="btn btn-transparent p-0 btn-sm mt-2 text-danger delete-btn" data-test="delete-item-btn"
                        @click="$emit('deleteItem',index);" type="button"><i class="las la-trash-alt"></i></button>
            </div>
        </div>
    </div>
</template>

<script>
import { v4 as uuidv4 } from 'uuid';
import MenuItemMixin from "./mixins/MenuItemMixin";

export default {
    name: "MenuItem",
    mixins: [MenuItemMixin],
    props: {
        index: {
            type: Number,
            required: true
        },
        isVisible: {
            type: Boolean,
            default: true
        },
        title: {
            type: String,
            required: true
        },
        slug: {
            type: String,
            required: true
        },
        id: {
            type: Number,
            required: true
        },
        hideViewChildrenBtn: {
            type: Boolean,
            default: false
        },
        sortHandle: String
    },
    emits: ['update:slug', 'update:title', 'update:isVisible', 'deleteItem'],

    created() {
        this.uuid = uuidv4();
    },
    mounted() {
      this.incrementMenuItemCount()
    },
    unmounted() {
      this.decrementMenuItemCount()
    },
    data() {
        return {
            showValidation: false,
            uuid:null
        }
    },
    computed: {
        isTitleInvalid() {
            return this.title.length === 0;
        },
        isSlugInvalid() {
            return this.slug.length === 0;
        },

    },
    methods: {
        setTopLevelMenuItemListId(id) {
            this.$store.commit('setTopLevelMenuItemListId', id)
        },
        incrementMenuItemCount() {
            this.$store.commit('incrementMenuItemCount');
        },
        decrementMenuItemCount() {
            this.$store.commit('decrementMenuItemCount');
        },
        revealValidation() {
            this.showValidation = true;
        }
    }
}
</script>

<style scoped lang="scss">
.btn {
    font-size: .75rem;

    &:focus {
        box-shadow: none;
    }
}

.delete-btn, .sort-handle {
    font-size: 1.6rem;
}

.sort-handle {
    cursor: grab;
}

.slug-input {
    font-family: "Courier New", Courier, monospace;
}

</style>
