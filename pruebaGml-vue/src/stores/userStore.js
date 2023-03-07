import { defineStore } from "pinia";
import axios from "axios";
import router from "@/router";

export const useUserStore = defineStore("users", {
    state: () => ({
        storeCategories: [],
        storeCountries: [],
        storeUsers: [],
        storeUser: null,
        storeErrors: [],
        storeStatus: null,
        storeMessage: null,
    }),
    getters: {
        categories: (state) => state.storeCategories,
        countries: (state) => state.storeCountries,
        users : (state) => state.storeUsers,
        user : (state) => state.storeUser,
        errors : (state) => state.storeErrors,
        status : (state) => state.storeStatus,
        message : (state) => state.storeMessage,
    },
    actions: {
        async getUsers() {
            const response = await axios.get("/api/users");
            this.storeUsers = response.data;
            
        },
        async getUser(id) {
            this.storeUser = null;
            const response = await axios.get(`/api/users/${id}`);
            this.storeUser = response.data;
        },
        async getUserPage(page) {
            const response = await axios.get(page);
            this.storeUsers = response.data;
        },
        async createUser(user) {
            this.storeStatus = null;
            this.storeMessage = null;
            this.storeErrors = [];
            try {
                const response = await axios.post("/api/users", user);
                this.storeStatus = response.status;
                this.storeMessage = response.data.message;
                router.push({ name: "Users" });

            } catch (error) {
                this.storeStatus = error.response.status;
                this.storeErrors = error.response.data.errors;
            }
        },
        async updateUser(user) {
            this.storeStatus = null;
            this.storeMessage = null;
            this.storeErrors = [];
            try {
                const response = await axios.put(`/api/users/${user.id}`, user);
                this.storeStatus = response.status;
                this.storeMessage = response.data.message;
                router.push({ name: "Users" });
            }
            catch (error) {
                this.storeStatus = error.response.status;
                this.storeErrors = error.response.data.errors;
            }
        },
        async deleteUser(id) {
            this.storeStatus = null;
            this.storeMessage = null;
            this.storeErrors = [];
            try {
                const response = await axios.delete(`/api/users/${id}`);
                this.storeStatus = response.status;
                this.storeMessage = response.data.message;
            }
            catch (error) {
                this.storeStatus = error.response.status;
                this.storeErrors = error.response.data.errors;
            }
        },
        async getCountries() {
            const response = await axios.get('https://restcountries.com/v3.1/region/ame');
            // todos los paises de la subregion South America
            let countries = response.data;
            countries = countries.filter(country => country.subregion === 'South America');
            // solo los nombres de los paises
            countries = countries.map(country => country.translations.spa.common);
            this.storeCountries = countries;
        },
        async getCategories() {
            const response = await axios.get('/api/category/categoryAll');
            this.storeCategories = response.data;
        },
        async getSearchedUsers(search) {
            const response = await axios.get(`/api/users/search/${search}`);
            this.storeUsers = response.data;
        }
    },
});

