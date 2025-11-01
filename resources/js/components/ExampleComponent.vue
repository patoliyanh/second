<template>
  <div>
    <h2>Hello from Vue.js!</h2>
    <button @click="count++">You clicked {{ count }} times</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      count: 0
    };
  }
};
</script>
