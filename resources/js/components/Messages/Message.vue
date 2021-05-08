<template>
    <div v-bind:class="{ 'align-self-end': align_end }" class="m-2">
        <p class="text">{{ name }}</p>
        <span class="w-25 border rounded p-1 text"> {{ text }} </span>
    </div>
</template>

<script>
export default {
    props: ["user_id", "text", "current_user"],
    data() {
        return {
            name: "",
            align_end: null
        };
    },
    created() {
        axios.get("api/user/" + this.user_id).then(response => (this.name = response.data.name));

        this.align_end = (this.user_id != this.current_user);
    }
};
</script>
