<template>
    <form>
        <button class="btn btn-light" data-toggle="collapse" data-target="#submitCollapse" @click="collapsed = !collapsed">{{!collapsed ? "Write post" : "Collapse"}}</button>
        <button v-if="collapsed" type="submit" class="btn btn-light">Submit</button>
        <div id="submitCollapse" class="collapse form-group">
            <br>
            <table class="table">
                <tr>
                    <td>Name:</td>
                    <td><input class="form-control" type="text" required v-model="name"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input class="form-control" type="email" required v-model="email"></td>
                </tr>
                <tr>
                    <td>Text:</td>
                    <td><textarea class="form-control" cols="30" rows="10" required v-model="text"></textarea></td>
                </tr>
            </table>
        </div>
    </form>
</template>

<script>
    export default {
        name: "SubmitComponent",
        data() {
            return {
                collapsed: false,
                name: '',
                email: '',
                text: ''
            }
        }
    }
</script>

<style scoped>

</style>
