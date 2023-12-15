<template>
    <div>
        <div class="flex flex-wrap">
            <form>
                <input type="text" name="plugin_name_option"/>
                <button type="submit">Save me</button>
            </form>
        </div>
    </div>
</template>
<script type="module">
    export default {
        name: "dashboard-page",
    };
</script>

<style lang="scss">
    /* Include the global SCSS file */
    @import './src/scss/admin/app';
</style>