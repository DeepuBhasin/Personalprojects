<template>
    <SectionHeader header="Ticket Category" :titleBoolen="true">
        <template v-slot:breadCrumbsLinks>
            <li class="breadcrumb-item active">
                <router-link to="/viewticketcategory">Ticket Category</router-link>
            </li>
        </template>
         <template v-slot:title>
            <h3 class="card-title">Ticket Category</h3>
            <router-link :to="{name:'CreateTicketCategory'}"><a class="btn btn-primary btn-sm pull-right" v-if="pagePermission.add">Create Ticket Category</a></router-link>
        </template>
        <template v-slot:body>
            <div class="col-md-12">
                <span v-if="pagePermission.edit ||  pagePermission.delete"></span>
                <span v-else>{{columns[3]=''}}</span>
                <ITable :classes="classes" :columns="columns" :rows="rows" :meta="meta" section="plan"></ITable>
            </div>
        </template>
    </SectionHeader>
</template>

<script>
import ITable from '@/components/ITable/ITable.vue'
import EditButton from '@/Pages/TicketCaregory/EditButton.vue';
import DeleteButton from '@/Pages/TicketCaregory/DeleteButton.vue'
import {mapState} from 'vuex';
import { api } from '@/store/api';
export default {
    name : 'ViewTicketCategory',
    components: {
        ITable,
        EditButton,
        DeleteButton
    },
    computed: {
        ...mapState('users', {
            pagePermission: (state) => {
                return {
                    page: state.permission?.ticket_category?.includes('page') ? true : false,
                    add: state.permission?.ticket_category?.includes('add') ? true : false,

                    edit: state.permission?.ticket_category?.includes('edit') ? true : false,
                }
            }
        }),
        ...mapState('helpers', ["planCurrentPage", "actionTaken", "refreshForm", "statusToken", "userType"])

    },
    watch: {
        status(to, from) {},
        type(to, from) {},

        statusToken(to, from) {
            this.refresh(this.userType, this.planCurrentPage)
        },
        planCurrentPage: function (to, from) {
            if (typeof to != "undefined")
                this.refresh(this.userType, to)
        },

        actionTaken: function (newState, oldState) {
            if (newState.status) {
                this.show(newState.msg, newState.type, 2000)
                if (newState.type == 'success') {
                    this.closeModal({
                        status: false
                    })
                }
                this.refresh(this.userType, this.planCurrentPage);

            }
        }
    },
    mounted: function () {
        this.refresh(this.cat_id, this.planCurrentPage);
    },
    inject: ["show", "hide"],
    data() {
        return {
            isChild: 'id' in this.$route.params,
            currentPlan: {},
            refresh: function (pageIndex) {
                api.get(`admin/ticketCategory?page=${this.planCurrentPage}`).then(data => {
                    return data.data;
                }).then(response => {
                    let rows = response.data.map(function (obj) {
                        obj.created_at = new Date(obj.created_at).toLocaleDateString();
                        return {
                            ...obj,
                            "actions": [{
                                EditButton,
                                props: {
                                    id: obj.id
                                }
                            },
                            {
                                DeleteButton,
                                props: {
                                    id: obj.id
                                }
                            }]
                        }

                    })
                    this.meta = response.meta
                    this.rows = rows;
                })
            },
            categoryTypes: [],
            classes: ["table", "table-stripped", "table-striped"],
            columns: [{
                    'title': 'ID',
                    key: 'id'
                },
                {
                    'title': 'Name',
                    key: 'name'
                },
                {
                    'title': 'Created Date',
                    key: `created_at`
                },
                {
                    'title': 'Actions',
                    key: 'actions'
                },
            ],
            rows: [],
            meta: {}
        }
    },
    created() {
        if (!this.pagePermission.page) {
            this.$router.push('/dashboard');
        }
    },

}
</script>
