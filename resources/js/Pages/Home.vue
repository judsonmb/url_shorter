<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="URL Shorter" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">URL Shorter</h2>
        </template>

        <div class="py-3">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" v-html="errorAlert">
            </div>
        </div>

        <div class="py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-10 text-gray-900">
                        <form class="w-full" @submit.prevent="createShortUrl()">
                            <div class="flex items-center border-b border-teal-500 py-2">
                              <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" required ref="url" type="text" value="http://" aria-label="url">
                                <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">
                                    Short
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center relative overflow-x-auto">
            <table class="text-sm m-auto text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ORIGINAL URL
                        </th>
                        <th scope="col" class="px-6 py-3">
                            SHORTED URL
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="url in urls" v-bind:key="url.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ url.original_url }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="#" @click="redirect(url.url_key)">
                                {{ url.short_url }}
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<script>
    import axios from 'axios'
    export default {
        mounted: function () {
            this.getUrls()
        },
        data: function () {
            return {
                urls: [],
                url: '',
                errorAlert: '',
            }
        },
        methods: {
            showError: function (message) {
                this.errorAlert = 
                '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">'+
                    '<strong class="font-bold">Error: </strong>'+
                    '<span class="block sm:inline"> '+message+'</span>'+
                '</div>'
            },
            getUrls: function () {
                var self = this
                const url = '/api/shorturls'
                axios.get(url, {
                dataType: 'json',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                mode: 'no-cors',
                credentials: 'include'
                })
                .then(function (response) {
                    self.urls = response.data
                })
                .catch(function (error) {
                    showError(error.message)
                })
            },
            redirect: function (url_key) {
                const url = '/api/'+url_key
                axios.post(url, {
                dataType: 'json',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: {

                },
                mode: 'no-cors',
                credentials: 'include'
                })
                .then(function (response) {
                    window.open(response.data, '_blank');
                })
                .catch(function (error) {
                    showError(error.message)
                })
            },
            createShortUrl: function () {
                var self = this
                self.url = this.$refs.url.value
                const url = '/api/shorturls'
                axios.post(url, {'original_url': this.url}, {
                    dataType: 'json',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    mode: 'no-cors',
                    credentials: 'include'
                })
                .then(function (response) {
                    location.reload()
                })
                .catch(function (error) {
                    self.showError(error.response.data.message)
                })
            }
        }
    }
</script>
