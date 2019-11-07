<template>
    <div>
        <table v-if="logged === 1">
            <tr>
                <td>
                    <button @click="index = status_published" :class="btnClassByStatus(status_published)">Published ({{countByStatus(status_published)}})</button>
                </td>
                <td>
                    <button @click="index = status_declined" :class="btnClassByStatus(status_declined)">Declined ({{countByStatus(status_declined)}})</button>
                </td>
                <td>
                    <button @click="index = status_new" :class="btnClassByStatus(status_new)">New ({{countByStatus(status_new)}})</button>
                </td>
            </tr>
        </table>
        <table class="table posts_table">
            <tbody>
                <tr v-if="post.status === index" v-for="post in posts">
                    <td>
                        <strong class="d-block text-gray-dark">{{post.name}}</strong>
                        <hr>
                        <strong class="d-block text-gray-dark">{{post.email}}</strong>
                        <hr>
                        {{post.created_at | moment("dddd, MMMM Do YYYY")}}
                    </td>
                    <td>{{post.content}}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>

    export default {
        props: [
            'posts',
            'logged'
        ],
        mounted() {
          if (this.logged !== 1) this.index = this.status_published;
        },
        data() {
            return {
                index: 0,
                status_new: 0,
                status_published: 1,
                status_declined: 2,
            }
        },
        methods: {
            countByStatus(status) {
                return this.posts.filter((post) => post.status === status).length
            },
            btnClassByStatus(status) {
                return status === this.index ? 'btn btn-dark' : 'btn btn-light'
            }
        }
    }
</script>

<style scoped>

    .posts_table {
        border-collapse: separate;
        border-spacing: 0 15px;
    }
</style>
