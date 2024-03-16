<template>
    <div class="container">
    <!-- Title section -->
        <div class="title text-center mt-2">
            <h1> CSV to Array</h1>
        </div>

    <!-- File Upload section -->
        <div class="">
            <input type="file" @change="handleFileUpload">
        </div>
    </div>
</template>
<script>
 export default {

    data() {
        return {
            file: []
        }
    },
    methods: {
        handleFileUpload(event) {
            this.file = event.target.files[0];
            this.getDataArray();
            
        },
        // send an api request to get the CSV data array
        getDataArray() {
            let formData = new formData();
            formData.append('file', this.file);

            this.axios.post('api/upload-csv', formData).then((data) => {

            });
        }

    },
 }
</script>