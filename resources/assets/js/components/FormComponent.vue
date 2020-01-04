<template>
    <div class="col-md-4">
        <form @submit.prevent="saveTweet">
            <div class="form-group">
                <textarea
                        class="form-control"
                        rows="8" cols="8"
                        maxlength="130"
                        v-model="body"
                        required>
                </textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">
                    发送
                </button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                body : ''
            }
        },
        methods : {
            saveTweet() {
                axios.post('/tweet/save', { body : this.body }).then(res => {
                    console.log(res.data);
                }).catch(e => {
                    console.error(e);
                });
                this.body = '';
            },
        }
    }
</script>

<style scoped>

</style>