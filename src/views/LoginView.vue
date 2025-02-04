<template>
    <div class="login-container">
      <login-comp/>
  </div>
</template>

<script>
import LoginComp from '@/components/LoginComp.vue';

export default {
  name: 'LoginView',
  components:{
      LoginComp
  }
  }

</script>