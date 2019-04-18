<template>
    <div>
        <div class="btn-wrapper">
            <router-link to="/Vue-Laravel-SPA/public/students/new" class="btn btn-primary btn-sm">New</router-link>
        </div>
        <userList></userList>
        
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
  import userList from '../../components/user-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      userList
    }
  }
</script>

<style scoped>
.btn-wrapper {
    text-align: right;
    margin-bottom: 20px;
}
</style>
