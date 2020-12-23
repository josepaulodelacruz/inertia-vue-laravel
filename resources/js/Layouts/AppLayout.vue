<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="flex justify-between bg-white mx-auto px-4 sm:px-6 lg:px-8 py-6 border-b w-full border-gray-100">
            <ul class="flex">
                <li class="pr-2">
                    <inertia-link :href="route('dashboard')">
                        <jet-application-mark class="block h-9 w-auto" />
                    </inertia-link>
                </li>
                <li class="px-3">
                    <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </jet-nav-link>
                </li>
                <li class="px-3">
                    <jet-nav-link :href="route('posts')" :active="route().current('posts')">
                        Posts
                    </jet-nav-link>
                </li>
            </ul>
            <ul class="flex items-center">
                <li v-if="$page.user" class="px-3">
                    <a href="/#">
                        {{ $page.user.name }}
                    </a>
                </li>
                <!-- Authentication -->
                <form v-if="$page.user" @submit.prevent="logout">
                    <jet-dropdown-link as="button">
                        Logout
                    </jet-dropdown-link>
                </form>
                <li v-if="!this.$page.user" class="px-3">
                    <a :href="route('login')">
                        Login
                    </a>
                </li>
                <li v-if="!this.$page.user"class="px-3" >
                    <a :href="route('register')">
                        Register
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <slot name="header"></slot>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            <slot></slot>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple>
        </portal-target>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

    export default {
        components: {
            JetApplicationMark,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },

        created() {
          console.log(this.$page.user);
        },


        methods: {
            logout() {
                axios.post(route('logout').url()).then(response => {
                    window.location = '/';
                })
            },
        }
    }
</script>
