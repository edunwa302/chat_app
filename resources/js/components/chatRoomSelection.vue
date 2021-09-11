<template>
<div class="px-2">
    <div>Room selection</div>
    <div class="grid sm:grid-cols-2 ">
        <div class="font-bold">
            {{ selected.name }} Chat
        </div>
        <select v-model="selected" @change="$emit('roomChanged', selected)">
            <option v-for="(room, index ) in rooms" :key="index" :value="room">{{ room.name }}</option>
        </select>
    </div>

</div>
</template>

<script>


export default {
    emits: ['roomChanged'],
    props: ['rooms', 'currentRoom'],
    components: {

    },
    data () {
        return {
            selected: ''
        }
    },
    methods: {
        roomSelected() {
            // this.$emit('roomChanged')
        }
    },
    created() {
        this.selected = this.currentRoom;
    },
}
</script>
