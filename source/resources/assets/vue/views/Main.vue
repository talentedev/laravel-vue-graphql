<template>
    <h1>Main View</h1>
</template>

<script>
export default {
    name: 'Main',
    created() {
        this.$apollo
            .query({
                query: require("../graphql/queries/profile.gql")
            })
            .then(response => {
                console.log(response);
        });
    }
}
</script>