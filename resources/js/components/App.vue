<template>
    <div>
        <router-view></router-view>
    </div>
</template>

<script>
    export default{
        created(){
            console.log("application loaded");
        }
    }
</script>