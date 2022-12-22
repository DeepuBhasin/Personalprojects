export default {
    namespaced:'modal',
    state: {
        status: false,
        id: 0,
        cat_id: 0,
        parent_id: 0,
        type: '',
        form: Object
    },
    getters: {
        getModalType(){
            return this.state.type;
        }
    },
    mutations: {
        updateStatus(state, payload){
            console.log("updateStatus",payload);
            state.status = payload.status
            state.id = payload.id
            if(typeof payload.parent_id != "undefined"){
                state.parent_id = payload.parent_id
            }
            if(typeof payload.type != "undefined"){
                state.type = payload.type
            }
            if(typeof payload.cat_id != "undefined"){
                state.cat_id = payload.cat_id
            }
            if(typeof payload.form != "undefined"){
                state.form = payload.form
            }
        }
    },
    actions:{
        toggleModal({commit},params){
            console.log("params",params);
            commit("updateStatus",params)
        }
    }
}