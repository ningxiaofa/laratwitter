<template>
    <div class="col-md-8 posts">
        <p v-if="!posts.length">No posts</p>
        <div class="media" v-for="post in posts" :key="post.id">
            <img class="mr-3" />
            <div class="media-body">
                <div class="mt-3">
                    <a :href="post.user.profileLink" target="_blank">{{ post.user.name }}</a> | {{ post.createdDate }}
                </div>
                <p>{{ post.body }}</p>
            </div>
        </div>
    </div>
</template>

<!--import Event from '../event.js';-->

<script>
    export default {
        data() {
            return {
                posts : [],
                post : {},
            }
        },
        mounted() {
            axios.get('/posts').then((resp => {
                this.posts = resp.data;
            }));
            // 定义了一个监听 added_tweet 事件的监听器，当该事件被触发后，就可以执行相应的方法将数据渲染到时间线组件中
            Event.$on('added_tweet', (post) => {
                this.posts.unshift(post);
            });
        }
    }
</script>

<style scoped>

</style>