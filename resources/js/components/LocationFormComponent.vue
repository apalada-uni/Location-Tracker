<template>
<div>
    <div class="card">
        <div class="form-group">
            <label for="locationName">Location Name</label>
            <input type="text" class="form-control" id="locationName" placeholder="Enter Location Name" v-model="newLocation.name"></br>
            <label for="locationAddress">Location Address</label>
            <input type="text" class="form-control" id="locationAddress" placeholder="Enter Location Address" v-model="newLocation.address">
        </div>
            <button type="button" class="btn btn-primary" @click="addLocation">Add</button>

    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            locations: [],
            newLocation: {
                name: null,
                address: null,
            }
        }
    },

    methods: {
        addLocation() {
            axios.post('/api/location', this.userLocation)

        }

    },


    mounted() {
            console.log('LocationFormComponent mounted.')
        }
}
</script>