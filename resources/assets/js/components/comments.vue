<template>
    <div class="container">
        <p> post id = {{props.post_id}}</p>
    </div>

</template>

<script>

    export default {

        name: "comments",
        data: function () {
            return{
               data:{},
                props:['post_id'],
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
