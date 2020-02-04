<template>
	<div class="container">
         <div class="col-md-12">
             <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-info float-right" v-b-modal.add-user>Add User</button>
                    </div>

                    <add-user></add-user>

                    <div class="card-body">
                        <user-table 
                            v-bind:users="users" 
                            v-on:del-user="deleteUser"
                            v-on:update-user="UpdateUser">
                        </user-table>
                    </div>
                </div>
            </div>
         </div>  
    </div>
</template>

<script>

    export default {

        data(){

            return {
                users : {},
            }
        },
        mounted(){

            this.getUsers()
        },
        methods : {

            getUsers(){

                axios.get('/api/users')
                    .then(response => {
                        
                        const sortByDesc = response.data.sort((a, b) => b.id - a.id)
                        this.users = sortByDesc
                    })
                    .catch(error => console.log(error))
            },
            addUser(newUser){

               axios.post(`/api/user`, newUser)
                .then(res => {
                    this.users.unshift(res.data)

                    console.log(this.users)

                })
                .catch(err => console.log(err))
            },
            deleteUser(id){

                axios.delete(`/api/user/${id}`)
                    .then(response => {

                        const filteredUsers = this.users.filter(user => user.id !== id)
                        this.users = filteredUsers
                    })
                    .catch(error => console.log(error))
            },
            UpdateUser(newUser){

                const payload = {

                    name : newUser.name,
                    email : newUser.email
                }

                axios.put(`/api/user/${newUser.id}`, payload)
                    .then(response => {
                        console.log(response.data)
                        // this.$root.$emit('bv::hide::modal', 'my-modal');
                    })
                    .catch(error => console.log(error))
            }
            
        }
    }
</script>