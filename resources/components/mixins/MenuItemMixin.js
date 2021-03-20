export default {
    computed: {
        getMenuItemCount() {
            return this.$store.state.menuItemCount;
        }
    },
    methods: {
        createBlankMenuItem(withColumns = false) {

            const generatedId = this.getMenuItemCount + 1;

            let item = {
                title: '',
                slug: '',
                isVisible: true,
                id: generatedId
            }

            if (withColumns) {
                item.columns = [];
            }

            return item;

        }
    }
}
