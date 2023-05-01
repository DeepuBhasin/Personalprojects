import axios from "axios";

export const baseURL = "http://dcltr.oidea.xyz/";

export const api = axios.create({
  baseURL:baseURL+'api/'
});

export function saveTokenToStorage(jwt) {
  localStorage.setItem('token',jwt);
}

export function setTokenInApiHeader(jwt) {
  api.defaults.headers.common["Authorization"] = `Bearer ${jwt}`;
}

export function clearToken() {
  localStorage.clear();
  delete api.defaults.headers.common["Authorization"];
}

export const getRequest= async function (httpAddress){
  try{
    let response = await api.get(httpAddress);
    return await response.data.data;
  }catch(error) {
    console.log(error);
    return String(error);
  }
}

export const putRequest = async function (httpAddress,data){
  try{
    return  await api.put(httpAddress,data);
  }catch(error) {
    console.log(error);
    return String(error);
  }
}

export const postRequest = async function (httpAddress,data){
  try{
    return  await api.post(httpAddress,data);
  }catch(error) {
    console.log(error);
    return String(error);
  }
}


export const postRequestForImage = async function (httpAddress,data){
  try{
    return  await api.post(httpAddress,data,{
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
  }catch(error) {
    console.log(error);
    return String(error);
  }
}

export const putRequestForImage = async function (httpAddress,data){
  try{
    return  await api.post(httpAddress,data,{
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
  }catch(error) {
    // console.log(error.response.data);
    // console.log(error.response.status);
    // console.log(error.response.headers);
    return error.response.data.errors;
  }
}

