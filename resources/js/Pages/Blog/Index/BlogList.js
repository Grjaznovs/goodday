import AppLayout from '@/Layouts/AppLayout.vue';
import SectionPage from "@/Components/SectionPage/SectionPage.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import EditSectionPage from "@/Components/SectionPage/EditSectionPage.vue";

export default {
    name: 'BlogList',

    props:{
        blog: {
            type: Object | Array,
            default: null
        }
    },

    components: {
        AppLayout,
        SectionPage,
        PrimaryButton,
        EditSectionPage
    },

    data() {
        return {
            form: [],
            loading: false
        }
    },

    methods: {
        addBlog () {
            this.$refs.runModalSectionPage.show();
        },

        submit (form) {
            return new Promise((resolve, reject) => {
                axios.post(`blog`, form)
                    .then(response => {
                        console.log(response.data)
                        resolve();
                    }).catch(error => {
                        reject(error.status);
                    }).finally(() => this.loading = false);
            });
        }
    }
}
