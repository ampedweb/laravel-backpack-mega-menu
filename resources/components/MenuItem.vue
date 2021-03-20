<template>
    <div class="card">
        <div class="card-body p-2">
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
                <button class="btn btn-primary btn-sm mt-2" type="button" data-test="view-children-btn" v-if="hideViewChildrenBtn === false"
                        @click="setTopLevelMenuItemListId(itemListId)">
                    View Children
                </button>
                <button class="btn btn-transparent btn-sm sort-handle text-primary p-0 mt-2 ml-auto mr-2" type="button">
                    <i class="las la-arrows-alt-h" v-show="sortHandle === 'horizontal'"></i>
                    <i class="las la-arrows-alt-v" v-show="sortHandle === 'vertical'"></i>
                    <i class="las la-arrows-alt" v-show="sortHandle === 'alldirections'"></i>
                </button>
                <button class="btn btn-transparent p-0 btn-sm mt-2 text-danger delete-btn" data-test="delete-item-btn"
                        @click="$emit('delete-item');" type="button"><i class="las la-trash-alt"></i></button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "MenuItem",
    props: {
        index: Number,
        title: {
            type: String,
            required: true
        },
        slug: {
            type: String,
            required: true
        },
        itemListId: {
            type:Number,
            required: true
        },
        hideViewChildrenBtn: {
            type: Boolean,
            default: false
        },
        sortHandle: String
    },
    data() {
        return {
            showValidation: false,
        }
    },
    computed: {

        isTitleInvalid() {
            return this.title.length === 0;
        },
        isSlugInvalid() {
            return this.slug.length === 0;
        }
    },
    methods: {
        setTopLevelMenuItemListId(itemListId) {
            this.$store.commit('setTopLevelMenuItemListId', itemListId)
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
