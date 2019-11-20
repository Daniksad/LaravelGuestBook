<template>
    <div>
        <table v-if="logged === 1">
            <tr>
                <td>
                    <button @click="index = status_published; setPage(1);" :class="btnClassByStatus(status_published)">Published ({{countByStatus(status_published)}})</button>
                </td>
                <td>
                    <button @click="index = status_declined; setPage(1);" :class="btnClassByStatus(status_declined)">Declined ({{countByStatus(status_declined)}})</button>
                </td>
                <td>
                    <button @click="index = status_new; setPage(1);" :class="btnClassByStatus(status_new)">New ({{countByStatus(status_new)}})</button>
                </td>
            </tr>
        </table>
        <table class="table text-break" v-for="post in postsPaginated">
            <tbody>
                <tr>
                    <td class="posts_first_column">
                        <strong class="d-block text-gray-dark">{{post.name}}</strong>
                        <hr>
                        <strong class="d-block text-gray-dark">{{post.email}}</strong>
                        <hr>
                        {{post.created_at | moment("dddd, MMMM Do YYYY")}}
                    </td>
                    <td>{{post.content}}</td>
                </tr>
                <tr>
                    <td class="posts_first_column text-center">
                    </td>
                    <td class="text-right">
                        <button data-toggle="collapse" :data-target="'#answerCollapse'+post.id" class="btn btn-dark btn-sm" v-if="findAnswer(post.id)">Read answer</button>
                        <button class="btn btn-dark btn-sm" v-if="findAnswer(post.id) && (logged === 1)" @click="deletePost(findAnswer(post.id).id)">Delete answer</button>
                        <button data-toggle="collapse" :data-target="'#answerCollapse'+post.id" class="btn btn-dark btn-sm" v-if="!findAnswer(post.id) && (logged === 1)">Answer</button>
                        <button class="btn btn-dark btn-sm" v-if="(post.status !== status_published) && (logged === 1)" @click="changeStatus(post.id, status_published)">Publish</button>
                        <button class="btn btn-dark btn-sm" v-if="(post.status !== status_declined) && (logged === 1)" @click="changeStatus(post.id, status_declined)">Decline</button>
                        <button class="btn btn-dark btn-sm" v-if="(post.status !== status_new) && (logged === 1)" @click="changeStatus(post.id, status_new)">Mark as New</button>
                        <button class="btn btn-dark btn-sm" v-if="logged === 1" @click="deletePost(post.id)">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td class="posts_first_column"></td>
                    <td>
                        <form>
                            <div :id="'answerCollapse'+post.id" class="collapse form-group text-right">
                                <form v-if="(logged === 1) && !findAnswer(post.id)">
                                    <textarea class="form-control" cols="30" rows="10" :id="'answer'+post.id" v-model="answers[post.id]"></textarea>
                                    <br>
                                    <button type="submit" class="btn btn-dark btn-sm" @click="addAnswer(post.id)">Submit</button>
                                </form>
                                {{findAnswer(post.id) ? findAnswer(post.id).name + ": " + findAnswer(post.id).content : ""}}
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn-toolbar">
            <div class="btn-group">
                <button :class="p === pagination.currentPage ? 'btn btn-dark' : 'btn btn-light'" v-for="p in pagination.pages" @click.prevent="setPage(p)">
                    {{p}}
                </button>
            </div>
        </div>
    </div>

</template>

<script>

    export default {
        props: [
            'logged',
            'user'
        ],
        mounted() {
            this.$store.dispatch('getAllPosts').then(this.fillPosts());
        },
        data() {
            return {
                posts: [],
                postsComponentKey: 0,
                index: 1,
                status_new: 0,
                status_published: 1,
                status_declined: 2,
                perPage: 3,
                answers: [],
                pagination: {}
            }
        },
        computed: {
            postsPaginated() {
                this.setPage(this.pagination.currentPage);
                return this.paginate(this.filterPosts(this.posts, this.index));
            }
        },
        methods: {
            fillPosts() {
                this.posts = this.$store.getters.posts;
                this.setPage(1);
            },
            changeStatus(id, status) {
                this.posts.find(p => p.id === id).status = status;
                this.$store.dispatch('changeStatus', this.posts.find(p => p.id === id));
                this.setPage(this.pagination.currentPage);
            },
            addAnswer(parent_id) {
                this.$store.dispatch('addPost', {
                    parent_id: parent_id,
                    name: this.user.name,
                    email: this.user.email,
                    content: this.answers[parent_id],
                    status: this.status_published
                });
            },
            deletePost(id) {
                this.$store.dispatch('deletePost', this.posts.find(p => p.id === id));
                this.posts.splice(this.posts.indexOf(this.posts.find(p => p.id === id)), 1);
                this.setPage(this.pagination.currentPage);
            },
            findAnswer(id) {
                return this.posts.find(p => p.parent_id === id)
            },
            filterPosts(posts, status) {
                return posts.filter((post) => post.status === status && post.parent_id === 0)
            },
            setPage(p) {
                this.pagination = this.paginator(this.filterPosts(this.posts, this.index).length, p);
            },
            paginate(data) {
                return _.slice(data, this.pagination.startIndex, this.pagination.endIndex + 1)
            },
            paginator(totalItems, currentPage) {
                let startIndex = (currentPage - 1) * this.perPage,
                    endIndex = Math.min(startIndex + this.perPage - 1, totalItems - 1);
                return {
                    currentPage: currentPage,
                    startIndex: startIndex,
                    endIndex: endIndex,
                    pages: _.range(1, Math.ceil(totalItems / this.perPage) + 1)
                };
            },
            countByStatus(status) {
                return this.filterPosts(this.posts, status).length
            },
            btnClassByStatus(status) {
                return status === this.index ? 'btn btn-dark' : 'btn btn-light'
            }
        },
        created() {

        }
    }
</script>

<style scoped>
    .posts_first_column {
        width: 200px;
    }
</style>
