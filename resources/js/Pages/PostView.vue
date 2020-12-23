<template>
    <app-layout>
        <template #header>
            <nav class="flex">
                <ul>
                    <li><a href="">{{ user.name }}</a></li>
                    <span>{{ posts.length }} posted and {{ user.total_likes }} likes</span>
                </ul>
            </nav>
        </template>

        <div class="flex lg:justify-center">
            <div class="bg-white p-6 w-8/12 mt-3 shadow rounded-lg">
                <div v-for="post in posts">
                    <Post :key="post.id" :subPost="post" />
                </div>
            </div>
        </div>
    </app-layout>

</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Post from '@/components/post'
    export default {
      components: {
        AppLayout,
        Post
      },
      props: [
        'posts',
        'user'
      ],
      mounted() {
        console.log(this.posts);
      }

    }
</script>
