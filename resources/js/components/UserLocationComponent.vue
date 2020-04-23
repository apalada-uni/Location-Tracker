<template>
<div>
    <div class="form-group">
        <label for="locationDropDownSelect">Location</label>
        <select class="form-control form-control-lg" id="locationDropDownSelect" v-model="userLocation.location_id" :disabled="isCheckedIn">
            <!-- <option value="" disabled selected="selected">Choose a Location</option> -->
            <option 
            v-for="location in locations"
            :value="location.id"
            :key="location.id"
            selected="getLocation"
            >{{ location.name }}</option>
        </select>
    </div>
    <div class="d-flex justify-content-center">
        <button @click="runMethod(buttonType)" class="btn btn-primary ">{{ buttonType }}</button>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            locations: [],
            userLocation: {
                id: null,
                user_id: null,
                location_id: null,
                check_in: null,
                check_out: null,
            }
        }
    },

    created() {
        // this.read();
        this.getLocations();
        this.getUserLastCheckIn();
    },

    computed: {
        buttonType() {
            if(!this.userLocation.check_in) {
                return "Check In";
            } else {
                return "Check Out";
            }
        },

        getLocation() {
            if(this.userLocation.location_id) {
                return this.userLocation.location_id;
            } else {
                return "";
            }
        },

        isCheckedIn() {
            if(this.userLocation.check_in) {
                return true;
            } else {
                return false;
            }
        }
    },

    methods: {
        read() {//index
            axios.get('/api/userlocation')
            .then(response => {
                this.locations = response.data[0];
                this.userLocation = Object.assign({
                    id: null,
                    user_id: null,
                    location_id: null,
                    check_in: null,
                    check_out: null,
                }, response.data[1]);
            })
        },

        getLocations() {//index
            axios.get('/api/location')
            .then(response => {
                this.locations = response.data;
            });
        },

        getUserLastCheckIn() {//lastcheckedin
            axios.get('/api/lastcheckin')
            .then(response => {
                this.userLocation = Object.assign({
                    id: null,
                    user_id: null,
                    location_id: null,
                    check_in: null,
                    check_out: null,
                }, response.data);
            })
        },

        checkIn() {//store
            axios.post('/api/userlocation', this.userLocation)
            .then(response => {
                this.userLocation = Object.assign({
                    id: null,
                    user_id: null,
                    location_id: null,
                    check_in: null,
                    check_out: null,
                }, response.data);
            })
        },

        checkOut() {//update
            window.axios.put(`/api/userlocation/this.userLocation.id`, this.userLocation)
            .then(response => {
                console.log(response.data);
                this.userLocation = Object.assign({
                    id: null,
                    user_id: null,
                    location_id: null,
                    check_in: null,
                    check_out: null,
                }, response.data);
            })
        },

        runMethod(buttonType) {
            if(buttonType == 'Check In') {
                this.checkIn();
            } else {
                this.checkOut();
            }
        }
    },

    mounted() {
            console.log('Example Component mounted.')
    }

    
}
</script>