import axios from 'axios';
import api from './config.js';
import { baseUrlApi } from './config.js';

const $api = axios.create({
    withCredentials: false,
    baseURL: baseUrlApi
});

export const getSections = async function() {
    return $api.get(api.sections.get);
}

export const getThemesAndSectionBySectionUrl = async function(section_url) {
    let data = {
        "section_url":section_url
    }
    return $api.post(api.themes_and_section.get_by_section_url,data);
}

export const getParagraphsAndThemeByUrl = async function(section_url,theme_url) {
    let token = localStorage.getItem('token');
    if (token == null || token == undefined) {
        return {
            status: 'notAuth'
        }
    }

    let data = {
        "custom_token":token,
        "section_url":section_url,
        "theme_url":theme_url
    }
    return $api.post(api.paragraphs.get_by_theme_and_section_url,data);
}

export const authorization = async function(name,password) {
    let data = {
        "name":name,
        "password":password
    }

    return $api.post(api.users.authorization,data);
}



//Здесь тестовые методы
export const test = async function() {
    return $api.get(api.test.get_headers);
}

export const test_get_token = async function(email,password) {
    let data = {
        "email":email,
        "password":password
    }
    return $api.post(api.test.get_token,data);
}

// export const test_get_me = async function(email,password) {
//     axios.defaults.headers.common['Authorization'] = 'Bearer '+localStorage.getItem('token');
//     axios
//         .get('http://127.0.0.1:8000/api/test_get_me')
//         .then(response => { 
//             console.log('sssssssss');
//             console.log(response)
//         })
//         .catch(error => console.log('Ошибка'+error));

// }