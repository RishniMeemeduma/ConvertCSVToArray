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
  const file = event.target.files[0];
  const reader = new FileReader();

  reader.onload = (e) => {
    const csvData = e.target.result;
    // Parse CSV data using Papaparse
    // const parsedData = Papa.parse(csvData, {
    //   header: true // If the CSV has a header row
    // });
    console.log(csvData); // Access parsed CSV data
  };

  reader.readAsText(file);
}
    },
 }
</script>