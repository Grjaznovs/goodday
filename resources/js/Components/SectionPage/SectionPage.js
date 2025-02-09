import SecondaryButton from '@/Components/SecondaryButton.vue';
import DeleteIcon from '@/Components/Icon/DeleteIcon.vue';

export default {
    name: 'SectionPage',

    props: {
        value: {
            type: Object | Array,
            default: null
        }
    },

    components: {
        SecondaryButton,
        DeleteIcon
    },

    methods: {
        toggleModal(id) {
            console.log('aaaa');
        }
    }
}
