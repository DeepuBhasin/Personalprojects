
import { createStore } from 'vuex';
import users from "./modules/users";
import modal from "./modules/modal";
import helpers from "./modules/helpers";

export default createStore({
   modules: {
    users,
    modal,
    helpers
    }
});

