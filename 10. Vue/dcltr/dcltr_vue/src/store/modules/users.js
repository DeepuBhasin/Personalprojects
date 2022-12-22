import { api, setTokenInApiHeader, saveTokenToStorage, clearToken } from "../api";

const namespaced = true;

const state = {
  userId: null,
  userName: null,
  email: null,
  phone_number: null,
  token: null,
  permission: null,
  role_id : null,
  auth : false,
};
const getters = {
  username(state) {
    return (state.user && state.user.userName) || null;
  },
  getStateValues(state){
    return state;
  }
};

const mutations = {
  setUser: (state, payload) => {
    state.userId = payload.userId;
    state.userName = payload.userName;
    state.email = payload.email;
    state.phone_number = payload.phone_number;
    state.token = payload.token;
    state.permission = payload.permission;
    state.role_id = payload.role_id;
    state.auth = true;
  },
  setError: (state, payload) => {
    state.stateError = payload;
  },
  logout: (state) => {
    state.userId = null;
    state.userName = null;
    state.email = null;
    state.phone_number = null;
    state.token = null;
    state.permission = null;
    state.role_id = null;
    state.auth = false;
  },

  setNewPassword: (state) => { },

  setUpdateProfile: (state, payload) => {
    state.userName = payload.name;
    state.phone_number = payload.phone_number;
  }

  // setInputValue: (state, payload) => {
  //   state.userName = payload;
  // },

};

const actions = {
  async loginUser({ commit }, userObject) {
    clearToken();
    const response = await api.post("/admin/login", userObject);
    if (response.status == 200) {
      let responseData = response.data.data;
      
      let responseUserObject = {
        userId: responseData.id,
        userName: responseData.name,
        email: responseData.email,
        phone_number: responseData.phone_number,
        token: responseData.token,
        permission: null,
        role_id : responseData.role_id,
        auth :  true
        
      }
      saveTokenToStorage(responseUserObject.token);
      setTokenInApiHeader(responseUserObject.token);

      commit("setUser", responseUserObject);

      let permissionResponse = await api.get("/admin/role/" + responseData.role_id);

      permissionResponse = permissionResponse.data.data.permission;

      responseUserObject = {
        ...responseUserObject,
        permission: permissionResponse
      };
      commit("setUser", responseUserObject);
    }
  },
  async getAdminDetails({ commit }, token) {
    setTokenInApiHeader(token);
    const response = await api.get("/admin/adminDetail");

    if (response.status == 200) {
      let responseData = response.data.data;
      
      let responseUserObject = {
        userId: responseData.id,
        userName: responseData.name,
        email: responseData.email,
        phone_number: responseData.phone_number,
        token: token,
        permission: null,
        role_id : responseData.role.id,
        auth :  true
      }
      saveTokenToStorage(responseUserObject.token);
      setTokenInApiHeader(responseUserObject.token);
      commit("setUser", responseUserObject);
     
      let permissionResponse = await api.get("/admin/role/" + responseUserObject.role_id);

      permissionResponse = permissionResponse.data.data.permission;

      responseUserObject = {
        ...responseUserObject,
        permission: permissionResponse
      };
      commit("setUser", responseUserObject);
      
      return responseUserObject;
    }
  },
  async changePassword({ commit }, userObject) {
    const response = await api.post("/admin/changePassword", userObject);
    if (response.status == 200) {

      commit("setNewPassword");
    }
  },
  async updateProfile({ commit }, userObject) {

    let userObjectNew = {
      'name': userObject.name,
      'phone_number': userObject.phone_number,
    };
    const response = await api.put(`admin/updateDetails/${userObject.id}`,
      userObjectNew);

    if (response.status == 200) {

      commit("setUpdateProfile", userObjectNew);
    }
  },
  async logoutUser({ commit }, token) {

    const response = await api.post("/admin/logout");
    if (response.status == 200) {
      clearToken();

      commit("logout");
    }
  }
}
export default {
  namespaced,
  state,
  getters,
  mutations,
  actions
}