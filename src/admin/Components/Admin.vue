<template>
  <div>
    <div class="relative bg-blueGray-100">
      <div class="px-4 md:px-10 mx-auto w-full -m-24">
        <Dashboard/>
        <router-view />
      </div>
    </div>
  </div>
</template>
<script type="module">
import Dashboard from './Dashboard.vue';
export default {
  name: "admin-layout",
  components: {
    Dashboard
  },
};
</script>
