<template>
    <div>
        <table class="table">
            <tbody>
                <tr v-for="post in posts">
                    <td><strong class="d-block text-gray-dark">{{post.email}}</strong><hr>{{post.created_at | moment("dddd, MMMM Do YYYY")}}</td>
                    <td>{{post.content}}</td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>

    export default {
        props: [
            'posts'
        ],
        mounted() {
            console.log('Component mounted.');
            this.update();
        },
        methods: {
            update() {
                console.log(this.posts)
            }
        }
    }
</script>

<style scoped>

</style>
