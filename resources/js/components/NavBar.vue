<template>

<nav class="navbar navbar-light position-fixed start-0 end-0">
  <div class="container-fluid">
    <div class="row">
      <div class="col">
       <div>{{name}}</div>

      </div>
    </div>
  </div>
</nav>

</template>

<script>
    export default {
      name: 'navbar',
      data() {
        return {
          name:'Denis'
        }
      },
    }
</script>
