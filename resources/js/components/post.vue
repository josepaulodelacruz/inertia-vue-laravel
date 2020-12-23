<template>
    <div class="py-1">
        <div class="flex justify-between">
            <div>
                <inertia-link :href="route('post.view', subPost.user)" class="font-bold">{{ subPost.user.name }}</inertia-link>
                <span class="text-sm text-gray-500">{{ diffForHumans(subPost.created_at) }}</span>
            </div>
            <button v-if="subPost.user_id === $page.user.id" @click="deletePost(subPost)" class="bg-red-500 text-white text-sm font-bold rounded shadow p-1">Delete</button>
        </div>
        <p>{{ subPost.body }}</p>
        <div class="flex items-center">
            <button @click="postLike(subPost)" class="text-blue-500 text-sm px-1">
                {{ hasBeenLike(subPost) }}
            </button>
            <p class="text-sm">{{ subPost.likes.length }} likes</p>
        </div>
    </div>
</template>

<script>
    import moment from 'moment'
    export default {
      props: [
        'subPost',
      ],
      methods: {
        deletePost(post) {
          post._method = "DELETE"
          this.$inertia.post(`/posts/${post.id}/delete`, post);
        },
        hasBeenLike(post){
          let a = post.likes.find((el) => el.user_id === this.$page.user.id);
          return a ? 'Unlike' : 'Like'
        },
        postLike(post) {
          let a = post.likes.find((el) => el.user_id === this.$page.user.id);
          if(!a) {
            this.$inertia.post(`/posts/${post.id}/like`, post)
          } else {
            console.log('Unlike')
          }
        },
        diffForHumans(date) {
          return moment(date).fromNow()
        }
      }
    }
</script>
