<template>
<div>
    <div class="card">
        <div class="form-group">
            <label for="locationName">Location Name</label>
            <input type="text" class="form-control" id="locationName" placeholder="Enter Location Name" :value="locationName"></br>
            <label for="locationAddress">Location Address</label>
            <input type="text" class="form-control" id="locationAddress" placeholder="Enter Location Address" :value="locationAddress">
        </div>
            <button type="button" class="btn btn-primary">Add</button>

    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            locations: [],
            locationName: '',
            locationAddress: '',
        }
    },


    mounted() {
            console.log('LocationFormComponent mounted.')
        }
}
</script>