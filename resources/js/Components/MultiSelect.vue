<template>
    <multiselect
        v-model="selected"
        :options="options"
        :multiple="multiple"
        :taggable="taggable"
        placeholder="Select option"
        label="name"
        track-by="name"
        @tag="handleTagCreation"
        :custom-label="customLabel"
    />
</template>

<script>
import Multiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.css'; // Ensure CSS is imported correctly

export default {
    components: {
        Multiselect
    },
    props: {
        value: {
            type: [Array, Object, String, Number],
            default: () => []
        },
        options: {
            type: Array,
            required: true
        },
        multiple: {
            type: Boolean,
            default: false
        },
        taggable: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            selected: this.value
        };
    },
    watch: {
        selected(newValue) {
            this.$emit('input', newValue);
        },
        value(newValue) {
            this.selected = newValue;
        }
    },
    methods: {
        handleTagCreation(newTag) {
            // Handle creation of new tags
            console.log('New tag created:', newTag);
            // Example: Add the new tag to options
            this.options.push({ name: newTag, id: Date.now() });
        },
        customLabel(option) {
            // Customize the display of options
            return option.name.toUpperCase(); // Example: Uppercase labels
        }
    }
};
</script>

<style scoped>
/* Add scoped styles here if needed */
</style>
