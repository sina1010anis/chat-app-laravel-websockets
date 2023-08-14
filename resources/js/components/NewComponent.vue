<template>
	<p v-for="user in users">
	        <span>{{ user.name }} </span><span>{{ (user.status == 1)? 'online' : 'ofline'}}</span>
	    </p>
</template>

<script setup lang="ts">
defineProps<{
	users: Record<string, any> | undefined;
}>()
</script>
