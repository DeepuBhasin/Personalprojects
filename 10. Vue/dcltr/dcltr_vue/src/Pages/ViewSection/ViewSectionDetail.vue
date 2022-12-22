<template>
<div class="content-wrapper" style="min-height: 242px">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 capital">View Section</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <router-link to="/">Home</router-link>
                        </li>
                        <li class="breadcrumb-item active">
                            <router-link to="/viewsection"
                            >Section Management</router-link>
                        </li>
                        <li class="breadcrumb-item active">View Section</li>
                    </ol>
                </div>
            </div>
            <!-- <div  class="row">
                <a class="btn btn-info btn-xs pull-right" @click="$router.go(-1)">Back</a>
            </div> -->
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <form action="" method="post" @submit.prevent="onSubmit" autocomplete="off">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th>Section Name</th>
                                        <th class="capital">Permissions</th>
                                    </tr>
                                    <tr v-for="(item,key) in permission" :key="key">
                                        <td class="capital">{{item}} </td>
                                        <td>Yes</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
</template>

<script>
import {
    api
} from '@/store/api';
export default {
    name: "ChangePassword",
    data() {
        return {
            name: '',
            permission: []
        };
    },
    mounted() {
        let id = this.$route.params.id;
        api.get('admin/section/' + id).then((data) => data).then(data => {
            let response = data.data.data;
            this.name = response.name;
            this.permission = response.permission;
        }).catch(error => {
            console.log(error);
        })
    }
};
</script>

<style>
</style>
