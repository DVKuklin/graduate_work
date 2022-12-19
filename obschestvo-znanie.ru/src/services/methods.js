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
    console.log(api.users.authorization);
    return $api.post(api.users.authorization,data);
}