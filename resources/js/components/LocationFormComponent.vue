<template>
<div>
    <div id="add-location-form" class="card">
        <div class="form-group">
            <label for="locationName">Location Name</label>
            <input type="text" class="form-control" id="locationName" placeholder="Enter Location Name" v-model="newLocation.name"></br>
            <label for="locationAddress">Location Address</label>
            <input type="text" class="form-control" id="locationAddress" placeholder="Enter Location Address" v-model="newLocation.address">
        </div>
            </br>
            <button type="button" class="btn btn-primary" @click="addLocation">Add</button>
    </div>
    </br>
    <div id="add-location-form" class="card">
        <h1>Available Locations:</h1>
        <div class="location-table">
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="location in locations">
                        <td>{{ location.name }}</td>
                        <td>{{ location.address }}</td>
                        <td>
                            <button type="button" class="btn btn-primary" @click="deleteLocation(location.id)">
                                Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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
            },
        }
    },

    created() {
        this.getLocations();
    },

    computed: {

    },

    methods: {
        addLocation() {//store of locationcontroller
            axios.post('/api/location', this.newLocation)
                .then(response => {
                    this.locations = response.data;
                });
        },

        deleteLocation(id) {//delete of locationcontroller

            axios.delete('/api/location/' + id)
                .then(response => {
                    this.locations = response.data;
                });
        },

        getLocations() {//index of locationcontroller
            axios.get('/api/location')
            .then(response => {
                this.locations = response.data;
            });
        },
    },


    mounted() {
            console.log('LocationFormComponent mounted.')
        }
}
</script>