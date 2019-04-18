<template>
<div>
    <h3>List of students</h3>
    <div class="alert alert-danger" v-if="has_error">
        <p>Error, unable to retrieve the list of students.</p>
    </div>

    <!-- <table class="table">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Registration Date</th>
        </tr>
        <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.created_at}}</td>

        </tr>
    </table> -->

    <table class="table">
            <thead>
                <th>Room</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </thead>
            <tbody>
                <!-- <template v-if="!customers.length">
                    <tr>
                        <td colspan="4" class="text-center">No Customers Available</td>
                    </tr>
                </template>
                <template v-else> -->
                    <tr v-for="customer in customers" :key="customer.id">
                        <td>{{ customer.room }}</td>
                        <td>{{ customer.name }}</td>
                        <td>{{ customer.email }}</td>
                        <td>{{ customer.phone }}</td>
                        <td>
                            <router-link :to="`/Vue-Laravel-SPA/public/students/${customer.id}`">View</router-link>
                        </td>
                    </tr>
                <!-- </template> -->
            </tbody>
        </table>

</div>
</template>

<script>
  export default {
    data() {
      return {
        has_error: false,
        customers: null
      }
    },

    mounted() {
      /*if (this.customers.length) {
        return;
      }*/

      this.getUsers()
    },

    methods: {
      getUsers() {
        /*this.$http({
          url: `/api/customers`,
          method: 'GET'
        })*/
        axios.get('/api/customers')
            .then((res) => {
              this.customers = res.data.customers
            }, () => {
              this.has_error = true
            })
      }
    }
  }
</script>
