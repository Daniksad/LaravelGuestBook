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
        <table class="table" v-for="post in postsPaginated">
            <tbody>
                <tr>
                    <td>
                        <strong class="d-block text-gray-dark">{{post.name}}</strong>
                        <hr>
                        <strong class="d-block text-gray-dark">{{post.email}}</strong>
                        <hr>
                        {{post.created_at | moment("dddd, MMMM Do YYYY")}}
                    </td>
                    <td>{{post.content}}</td>
                </tr>
                <tr v-if="logged === 1">
                    <td></td>
                    <td class="text-right">
                        <button data-toggle="collapse" :data-target="'#answerCollapse'+post.id" class="btn btn-dark btn-sm" v-if="post.status === status_published">Answer</button>
                        <button class="btn btn-dark btn-sm" v-if="post.status !== status_published">Publish</button>
                        <button class="btn btn-dark btn-sm" v-if="post.status !== status_declined">Decline</button>
                        <button class="btn btn-dark btn-sm" v-if="post.status !== status_new">Mark as New</button>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <form>
                            <div :id="'answerCollapse'+post.id" class="collapse form-group text-right">
                                <textarea class="form-control" cols="30" rows="10"></textarea>
                                <br>
                                <button type="submit" class="btn btn-dark btn-sm">Submit</button>
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
            'posts',
            'logged'
        ],
        mounted() {
          if (this.logged !== 1) this.index = this.status_published;
        },
        data() {
            return {
                index: 1,
                status_new: 0,
                status_published: 1,
                status_declined: 2,
                perPage: 3,
                pagination: {}
            }
        },
        computed: {
            postsPaginated() {
                return this.paginate(this.posts.filter((post) => post.status === this.index));
            }
        },
        methods: {
            setPage(p) {
                this.pagination = this.paginator(this.posts.filter((post) => post.status === this.index).length, p);
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
                return this.posts.filter((post) => post.status === status).length
            },
            btnClassByStatus(status) {
                return status === this.index ? 'btn btn-dark' : 'btn btn-light'
            }
        },
        created() {
            this.setPage(1);
        }
    }
</script>

<style scoped>
    .posts_table {
        border-collapse: separate;
        border-spacing: 0 15px;
    }
</style>
