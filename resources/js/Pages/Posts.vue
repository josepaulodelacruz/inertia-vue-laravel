<template>
    <app-layout>
        <template #header>
            <nav class="flex">
                <ul>
                    <li><a href="">Posts</a></li>
                </ul>
            </nav>
        </template>

        <div class="flex lg:justify-center">
            <div class="bg-white p-6 w-8/12 mt-3 shadow rounded-lg">
                <label>Posts</label>
                <form @submit.prevent="post">
                    <textarea
                        v-model="form.body"
                        class="bg-gray-200 rounded-lg p-2 w-full"
                        name="body"
                        id="body"
                        cols="30"
                        rows="4">
                    </textarea>
                    <button type="submit" class="bg-blue-500 rounded-lg w-full p-4 text-white font-bold">Post</button>
                </form>

                <div v-for="post in posts">
                    <Post :key="post.id" :subPost="post" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import moment from 'moment';
    import AppLayout from "@/Layouts/AppLayout";
    import Post from '@/components/post'
    export default {
        components: {
            AppLayout,
            Post
        },
        props: [
          'posts',
        ],
        data() {
            return {
                form: {
                  body: null,
                },
                editMode: false,
            }
        },
        methods: {
          post() {
            if(this.form.body !== "") {
              this.$inertia.post('/posts', this.form);
              this.form.body = "";
            } else {
              alert('Please fill up')
            }
          },
        }
    }

</script>

