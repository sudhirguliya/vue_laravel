<template>
<div>
    <h3>List of students room</h3>
    <div class="alert alert-danger" v-if="has_error">
        <p>Error, unable to retrieve the list of rooms.</p>
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
                
                <th>Room Name</th>
                <!-- <th>Actions</th> -->
            </thead>
            <tbody>
                <!-- <template v-if="!customers.length">
                    <tr>
                        <td colspan="4" class="text-center">No Customers Available</td>
                    </tr>
                </template>
                <template v-else> -->
                    <tr v-for="room in rooms" :key="room.id">
                       
                        <td>{{ room.room | capitalize }}</td>
                        
                        <!-- <td>
                            <router-link :to="`/rooms/${room.id}`">View</router-link>
                        </td> -->
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
        rooms: null
      }
    },

    mounted() {
      /*if (this.rooms.length) {
        return;
      }*/
      
      this.getUsers()
    },

    methods: {
      getUsers() {
        /*this.$http({
          url: `/api/rooms`,
          method: 'GET'
        })*/
        axios.get('/api/rooms')
            .then((res) => {
              this.rooms = res.data.rooms
            }, () => {
              this.has_error = true
            })
      }
    }
  }
</script>
