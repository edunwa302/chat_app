<template>
<div class="">
    <div class="text-center text-sm">Message view</div>
    <div class="h-full p-2 flex flex-col-reverse overflow-scroll">
        <div v-for="(message, index) in messages" :key="index">
            <messageItem :message="message"/>
        </div>
    </div>

</div>
</template>

<script>
    import messageItem from '@/components/messageItem';
export default {
    components: {
        messageItem
    },
    props:['messages']

}
</script>
