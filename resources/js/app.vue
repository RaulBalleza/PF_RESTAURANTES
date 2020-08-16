<template>
  <div>
    <!-- Begin Page Content -->
    <transition>
      <router-view></router-view>
    </transition>
  </div>
</template>


<script>
export default {
  data() {
    return {};
  },
  mounted() {
      console.log("app.vue montado");
  },
};
</script>