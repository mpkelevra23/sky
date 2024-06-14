import axios from 'axios';
// Определяем axios как глобальную переменную для использования во всех компонентах
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
