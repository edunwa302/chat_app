<template>
<div>
    <div class="flex flex-row items-center mb-4" >
        <div
            class="flex items-center p-2 justify-center rounded-full bg-gray-300 text-white mr-2"
            :class="{ 'bg-green-300' : admin, 'rounded-xl' : admin, 'admin-wrapper' : admin  }">
            {{ message.user.name }}
        </div>
        <div :class="{'text-green-500' : admin}">{{ message.message }}</div>
    </div>
</div>
</template>

<script>
export default {
    props: ['message'],
    computed: {
        admin() {
            return this.message.user.isAdmin
        }
    }
}
</script>
<style scoped>
.admin-wrapper {
    border-radius: 100%;
    width: 3rem;
    height: 3rem;
}
</style>
