import { api } from '../api';
export default {

    namespaced: "helpers",
    state:{
        section: '',
        categoryTypes: [],
        sortable:{
            sortKey: "id",
            sortDirection: 1,
            section:""
        },
        perPage:{
            rowsPerPage: 10,
            section:""
        },
        filterCriteria:[],
        catCurrentPage: 1,
        formCurrentPage: 1,
        userCurrentPage: 1,
        planCurrentPage: 1,
        statusToken:0,
        actionTaken:{
            type:'success',
            status: false,
            msg:'',
            
        }
    },
    getters:{
        getCatCurrentPage(){
            return this.state.catCurrentPage;
        },

    },
    mutations:{
        setCatCurrentPage(state, payload){
            state.catCurrentPage = payload.currentPage;
        },
        setUserCurrentPage(state, payload){
            state.userCurrentPage = payload.currentPage;
        },
        setPlanCurrentPage(state, payload){
            state.planCurrentPage = payload.currentPage;
        },
        setFormCurrentPage(state, payload){
            
            state.formCurrentPage = payload.currentPage;
            console.log("Form State Updated", state)
        },
        setServiceCurrentPage(state, payload){
            state.serviceCurrentPage = payload.currentPage;
            console.log("Service State Updated", state)
        },
        setProductCurrentPage(state, payload){
            
            state.productCurrentPage = payload.currentPage;
            console.log("Product State Updated", payload)
        },
        deleteCategory(state, payload){
            state.catCurrentPage = payload.catCurrentPage;
            console.log("Am Payload", payload);
            state.actionTaken = {status: true, msg:payload.data.message}
            console.log("am payload", state)
        },
        deleteUser(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
            console.log("am payload", state)
        },
        closeTicket(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
            
        },
        blockUnblockUser(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
            console.log("am payload", state)
        },
        delectSection(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
            console.log("am payload", state)
        },
        blockUnBlockAdmin(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
            console.log("am payload", state)
        },
        deleteAdminUsers(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
            console.log("am payload", payload)
        },
        deleteTicketCategory(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
        },
        deleteCampaign(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
        },
        statusCampaign(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
        },
        proUnproUser(state, payload){
            state.userCurrentPage = payload.userCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
            console.log("am payload", state)
        },
        deleteForm(state, payload){
            //state.catCurrentPage = payload.catCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
            console.log("am payload", state)
        },
        deletePlan(state, payload){
            //state.catCurrentPage = payload.catCurrentPage;
            state.actionTaken = {status: true, msg:payload.data.message}
            console.log("am payload", state)
        },
        setSortState(state, payload){
            //state.catCurrentPage = payload.catCurrentPage;
            state.sortable = {...payload, sortDirection:payload.sortDirection==-1?1:-1}
        },
        setRowsPerPageState(state, payload){
            //state.catCurrentPage = payload.catCurrentPage;
            state.perPage = {...payload, rowsPerPage:payload.rows_per_page}
        },
        _refresh(state, payload){
            if((payload.data).hasOwnProperty("type")){
                state.actionTaken = {status: payload.data.status, type: payload.data.type,  msg:payload.data.message};
            }
            else{
                state.actionTaken = {status: payload.data.status, msg:payload.data.message};
            }
            
            state.statusToken= Math.random();
        },
        _addPlan(state, payload){
            state.actionTaken = {status: payload.status, type:"success",msg:payload.message},
            state.statusToken= Math.random();
        },
        _updateService(state, payload){
            state.actionTaken = {status: payload.status, type:"success",msg:payload.msg},
            state.statusToken= Math.random();
        },
        _updateProduct(state, payload){
            state.actionTaken = {status: payload.status, type:"success",msg:payload.msg},
            state.statusToken= Math.random();
        },
        _updateCatTypes(state, payload){
            state.categoryTypes = payload.categoryTypes
            
        },
        _updateFilter(state, payload){
            state.filterCriteria = payload;
            // let isExisting = state.filterCriteria.filter(item=>item.filterKey==payload.filterKey)
            // if(isExisting){
            //     state.filterCriteria.filter(item=>item.filterKey==payload.filterKey)[0] = payload;
            // }
            // else{
            //     state.filterCriteria.push(payload)
            // }
            // = {...state.filterCriteria, payload}
            
        },
        _toggleFilter(state, payload){
            console.log("toggling Now", payload);
            
        }
    },
    actions:{
        capitalize(s){
            return s[0].toUpperCase() + s.slice(1);
        },
        refresh({commit},payload){
            commit('modal/updateStatus', {status:false}, { root: true })
            commit("_refresh",payload);
        },
        refreshForm({commit},payload){
            commit("_refresh",payload);
        },
        updateCatCurrentPage({commit},payload){
            console.log("Upddate Cat Current Page", payload)
            commit("setCatCurrentPage",payload);
        },
        updateCurrentPage({commit},payload){
            console.log("Upddate Cat Current Page", payload);
            commit(`set${(payload.section)[0].toUpperCase() + (payload.section).slice(1)}CurrentPage`,payload);
        },
        sortIt({commit},payload){
            console.log("Upddate Cat Current Page", payload);
            commit(`setSortState`,payload);
        },
        toggleFilter({commit},payload){
            console.log("toggleFilter Current Page", payload);
            commit(`_toggleFilter`,payload);
        },
        updatePerRow({commit},payload){
            console.log("Upddate Cat Current Page", payload);
            commit(`setRowsPerPageState`,payload);
        },
        addPlan({commit},payload){
            console.log("Add Plan Called", payload)
            commit(`_addPlan`,payload);
        },
        updateFilter({commit},payload){
            //console.log("Add Plan Called", payload)
            commit(`_updateFilter`,payload);
        },
        async deleteTicketCategory({commit},payload){
            let response = await api.delete("admin/ticketCategory/"+payload.id)
            commit("deleteTicketCategory",response);
        },
        async deleteCategory({commit},payload){
            let response = await api.delete("admin/category/deleteCategory?id="+payload.id)
            console.log("response of delete", response)
            commit("deleteCategory",response);
        },
        async deleteForm({commit},payload){
            let response = await api.delete("admin/form/delete/"+payload.id)
            console.log("response of delete", response)
            commit("deleteForm",response);
        },
        async deleteUser({commit},payload){
            let response = await api.delete("admin/deleteUser/"+payload.id)
            console.log("response of delete", response)
            commit("deleteUser",response);
        },
        async deletePlan({commit},payload){
            let response = await api.delete("admin/subscription/"+payload.id)
            console.log("response of delete", response)
            commit("deletePlan",response);
        },
        async blockUser({commit},payload){
            let response = await api.get("admin/blockUser/"+payload.id)
            console.log("blockUser Clicked", response)
            commit("blockUnblockUser",response);
        },
        async unblockUser({commit},payload){
            let response = await api.get("admin/unBlockUser/"+payload.id)
            console.log("response of delete", response)
            commit("blockUnblockUser",response);
        },
        async markNormal({commit},payload){
            let response = await api.get("admin/markNormal/"+payload.id)
            console.log("markNormal Clicked", response)
            commit("proUnproUser",response);
        },
        async markPro({commit},payload){
            let response = await api.get("admin/markPro/"+payload.id)
            console.log("markPro of delete", response)
            commit("proUnproUser",response);
        },
        async closeTicket({commit},payload){
            let response = await api.post("admin/ticket/updateStatus/"+payload.id,{status : payload.status})
            commit("closeTicket",response);
        },
        async blockUnBlockAdmin({commit},payload){
            let response = await api.put("admin/blockUnblockAdminUser/"+payload.id)
            commit("blockUnBlockAdmin",response);
        },
        async delectSection({commit},payload){
            let response = await api.delete("admin/section/"+payload.id)
            commit("delectSection",response);
        },
        async updateService({commit},payload){
            
            commit("_updateService",payload);
        },
        async updateProduct({commit},payload){
            
            commit("_updateProduct",payload);
        },
        async updateCatTypes({commit},payload){
            
            commit("_updateCatTypes",payload);
        },
        async deleteAdminUsers({commit},payload){
            let response = await api.delete("admin/deleteAdminUser/"+payload.id)
            commit("deleteAdminUsers",response);
        },
        async deleteCampaign({commit},payload){
            let response = await api.delete("admin/campaign/"+payload.id)
            commit("deleteCampaign",response);
        },
        async statusCampaign({commit},payload){
            let response = await api.put("admin/campaign/updateStatus/"+payload.id)
            commit("statusCampaign",response);
        },
    }
}