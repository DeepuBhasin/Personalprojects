<template>
    <h2>Search User</h2><br/>
    <div class="form-group">
        <input type="text" class="form-control" name="search" placeholder="Enter First Name" @input="serachUserMethod" v-model="serachUserValue"><br/>
    </div>
    <div class="form-group">
        <div v-if="users.length">
        <table v-if="users.length" class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in users" :key="item.user_id">
                    <td>{{ item.user_id }}</td>
                    <td>{{ item.first_name }}</td>
                    <td><router-link :to="{name : 'viewuser', params : {id : item.user_id}}" class="btn btn-success btn-sm">View User</router-link></td>
                </tr>
            </tbody>
        </table>
        </div>
        <div v-else>
            <div class="alert alert-info">
                No User Found
            </div>
        </div>
    </div>
</template>
<script>
import { getRequest, getTokenStorage } from '@/api/api-functions'
export default {
    name : 'SearchUserComponent',
    data() {
        return {
            users : [],
            serachUserValue : '',
            id : ''
        }
    },
    methods: {
        async serachUserMethod() {

            if(this.serachUserValue) {
                let reponseData = await getRequest(`search_user/${this.id}/${this.serachUserValue}`);
                this.users = reponseData.data; 
            } else {
                await this.getUserList()
            }
            
            
        },
        async getUserList() {
            let reponseData = await getRequest(`all_users/${this.id}`);
            this.users = reponseData.data;
        }

    },
    async mounted(){
        this.id = getTokenStorage();
        this.serachUser = '';
        await this.getUserList();
    }

}
</script>