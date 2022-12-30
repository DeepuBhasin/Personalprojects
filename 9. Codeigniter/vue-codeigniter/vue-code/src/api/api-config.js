import axios from 'axios';

const apiBaseUrl = 'http://127.0.0.1/testingProject/vue-codeginter2/';
const newAxios = axios.create({
    baseURL: apiBaseUrl,
    headers : {
        'Accept' : 'application/json'
    }
});

export default newAxios; 

