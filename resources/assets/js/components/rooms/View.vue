<template>
    <div class="room-view" v-if="room">
        
        <div class="user-info">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <td>{{ room.id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ room.room }}</td>
                </tr>
                
            </table>
            <router-link to="/rooms">Back to all rooms</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'view',
        created() {
            if (this.rooms.length) {
                this.room = this.rooms.find((room) => room.id == this.$route.params.id);
            } else {
                axios.get(`/api/rooms/${this.$route.params.id}`)
                    .then((response) => {
                        this.room = response.data.room
                    });
            }
        },
        data() {
            return {
                room: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            rooms() {
                return this.$store.getters.rooms;
            }
        }
    }
</script>

<style scoped>
.room-view {
    display: flex;
    align-items: center;
}
.user-img {
    flex: 1;
}
.user-img img {
    max-width: 160px;
}
.user-info {
    flex: 3;
    overflow-x: scroll;
}
</style>
