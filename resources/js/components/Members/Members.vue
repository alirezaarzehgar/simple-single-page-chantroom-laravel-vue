<template>
    <div>
        <ul>
            <li
                class="text"
                v-for="(active, index) in Actives"
                :key="index"
                v-text="active.user"
            ></li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ["user_id"],
    data() {
        return {
            Actives: []
        };
    },
    created() {
        axios.get("api/actives").then(r => (this.Actives = r.data));

        window.Echo.channel("chat.Active").listen("ActiveEvent", e => {
            if (!e.delete, !this.Actives.some(data => data.user === e.name)) {
                this.Actives.push({ user: e.name });
            } else if (e.delete) {
                this.Actives.splice(this.Actives.indexOf(e.name));
            }
        });

        window.addEventListener("beforeunload", this.closing);
    },
    methods: {
        closing() {
            axios.post("api/actives", { userId: this.user_id });
        }
    }
};
</script>
