<template>
    <div>
        <div class="btn-wrapper">
            <router-link  to="/rooms/new" class="btn btn-primary btn-sm">New</router-link>
        </div>
        <roomList></roomList>
        
    </div>
</template>

<!-- <script>
    export default {
        name: 'list',
        mounted() {
            if (this.customers.length) {
                return;
            }
            
            this.$store.dispatch('getCustomers');
        },
        computed: {
            customers() {
                return this.$store.getters.customers;
            }
        }
    }
</script> -->

<script>
  import roomList from '../../components/room-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      roomList
    }
  }
</script>

<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>
