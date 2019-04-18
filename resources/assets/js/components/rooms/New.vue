<template>
    <div class="room-new">
        <div class="alert alert-danger" v-if="has_error && !success">
                    <p v-if="error == 'registration_validation_error'">Validation error (s), please consult the message (s) below.</p>
                    <p v-else>Error, can not register for the moment. If the problem persists, please contact an administrator.</p>
                </div>

        <form @submit.prevent="add">
            <table class="table">
               
                <tr>
                    <th>Name</th>
                    <td>
                        <input type="text" class="form-control" v-model="room.room_name" placeholder="Room Name"/>
                    </td>
                </tr>
                

               
                <tr>
                    <td>
                        <router-link to="/rooms" class="btn">Cancel</router-link>
                    </td>
                    <td class="text-right">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <div class="errors" v-if="errors">
            <ul>
                <li v-for="(fieldsError, fieldName) in errors" :key="fieldName">
                    <strong>{{ fieldName }}</strong> {{ fieldsError.join('\n') }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import validate from 'validate.js';

    export default {
        name: 'new',
        data() {
            return {
                room: {
                   
                    room_name: '',
                    
                },
                has_error: false,
                errors: null
            };
        },
        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            }
        },
        methods: {
            add() {
                this.errors = null;

                const constraints = this.getConstraints();

                const errors = validate(this.$data.room, constraints);

                if(errors) {
                    this.errors = errors;
                    return;
                }

                axios.post('/api/rooms/new', this.$data.room)
                    .then((response) => {
                        this.$router.push('/rooms');
                        //this.$router.push({name: 'students'});
                    })
                    .catch((err) =>{
                        console.log(err)
                        this.has_error = true
                        //this.error = res.response.data.error
                        //this.errors = res.response.data.errors || {}
                        //rej("Wrong email or password");
                    });
            },
            getConstraints() {
                return {
                    
                    room_name: {
                        presence: true,
                        length: {
                            minimum: 3,
                            message: 'Must be at least 3 characters long'
                        }
                    }
                };
            }
        }
    }
</script>

<style>
.errors {
    background: lightcoral;
    border-radius:5px;
    padding: 21px 0 2px 0;
}
</style>

