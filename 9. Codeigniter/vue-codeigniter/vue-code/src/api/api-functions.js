import axios from "@/api/api-config";

export const baseImageUrl = 'https://127.0.0.1/testingProject/vue-codeginter2/upload/excel_file/';

export function saveTokenToStorage(jwt) {
  localStorage.setItem('token', jwt);
}

// export function setTokenInApiHeader(jwt) {
//   axios.defaults.headers.common["Authorization"] = `Bearer ${jwt}`;
// }

export function getTokenStorage() {
  return localStorage.getItem('token');
}

export function clearToken() {
  localStorage.clear();
  // delete axios.defaults.headers.common["Authorization"];
}


// Post Request 
export const getRequest = async function (httpAddress) {
  try {
    let response = await axios.get(httpAddress);
    return await response.data;
  } catch (error) {
    console.log(error);
    return String(error);
  }
}

export const postRequest = async function (httpAddress, data) {
  try {
    return await axios.post(httpAddress, data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    });
  } catch (error) {
    console.log(error);
    return String(error);
  }
}

export const putRequest = async function (httpAddress, data, ) {
  try {
    return await axios.put(httpAddress, data, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    });
  } catch (error) {
    console.log(error);
    return String(error);
  }
}



export const postRequestForImage = async function (httpAddress, data) {
  try {
    return await axios.post(httpAddress, data, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
  } catch (error) {
    console.log(error);
    return String(error);
  }
}

export const putRequestForImage = async function (httpAddress, data) {
  try {
    return await axios.post(httpAddress, data, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });
  } catch (error) {
    // console.log(error.response.data);
    // console.log(error.response.status);
    // console.log(error.response.headers);
    return error.response.data.errors;
  }
}

