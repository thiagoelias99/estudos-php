import axios from "axios";

// Create axios client
const axiosClient = axios.create({
    baseURL: `${import.meta.env.VITE_API_BASE_URL}/api`
})


// Add a request interceptor
axiosClient.interceptors.request.use((request) => {
    const token = localStorage.getItem('ACCESS_TOKEN');
    request.headers.Authorization = `Bearer ${token}`;
    return request;
})


// Add a response interceptor
axiosClient.interceptors.response.use((response) => {
    // Any status code that lie within the range of 2xx cause this function to trigger
    return response
},
    (error) => {
        const { response } = error;
        if (response.status === 401) {
            localStorage.removeItem('ACCESS_TOKEN')
            //Redirect to login
        } else if (response.status === 404) {
            //Show not found
        }

        throw error;
    })

export default axiosClient
