<template>
    <Head title="users">
        <meta name="description" content="Users page meta description of MyApp." head-key="descriptopn">
    </Head>

        <h1 class="text-3xl">
            Users
        </h1>

    <ul>
        <li v-for="user in users" :key="user.id" v-text="user.name"></li>
    </ul>
</template>

<script setup>

    defineProps( {users: Array})

</script>
