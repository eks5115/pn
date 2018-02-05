import axios from 'axios'

import { ls } from '@/services'

/**
 * Responsible for all HTTP requests.
 */
export const http = {
  request (method, url, data, successCb = null, errorCb = null) {
    axios.request({ url, data, method: method.toLowerCase() }).then(successCb).catch(errorCb)
  },

  get (url, successCb = null, errorCb = null) {
    return this.request('get', url, {}, successCb, errorCb)
  },

  post (url, data, successCb = null, errorCb = null) {
    return this.request('post', url, data, successCb, errorCb)
  },

  put (url, data, successCb = null, errorCb = null) {
    return this.request('put', url, data, successCb, errorCb)
  },

  delete (url, data = {}, successCb = null, errorCb = null) {
    return this.request('delete', url, data, successCb, errorCb)
  },

  /**
   * Init the service.
   */
  init () {
    axios.defaults.baseURL = window.BASE_URL+'api';

    // Intercept the request to make sure the token is injected into the header.
    axios.interceptors.request.use(
      config => {
        config.headers.Authorization = `Bearer ${ls.get('jwt-token')}`;
        return config;
      },
      error => {
        return Promise.reject(error);
      }
    );

    // Intercept the response and…
    axios.interceptors.response.use(
      response => {
        // …get the token from the header or response data if exists, and save it.
        const token = response.headers['Authorization'] || response.data['token'];
        token && ls.set('jwt-token', token);

        return response;
      },

      error => {
        if (error.response) {
          switch (error.response.status) {
            case 401:
              // 401 Unauthorized
              ls.remove('jwt-token');
              location.href = window.BASE_URL;
          }
        }

        return Promise.reject(error);
      }
    );
  }
};
