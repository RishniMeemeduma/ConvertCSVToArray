<template>
  <div class="csv_file_container" style="">
    <div class="container">
      <!-- Title section -->
      <div class="title text-center mt-2">
        <h1>CSV to Array Conversion</h1>
      </div>

      <!-- File Upload section -->
      <div class="upload_file mt-5">
        <b>Upload CSV file : </b>
        <input type="file" @change="handleFileUpload" />
      </div>

      <div class="alert alert-danger mt-3" v-if="errors.length > 0 || errors['file']">
        <ul v-if="errors">
          <li v-for="error in errors" v-if="!errors['file']">
            {{ error }}
          </li>
          <li v-else>
            {{ errors["file"][0] }}
          </li>
        </ul>
      </div>

      <!-- owner data section  -->
      <div v-else class="pt-5 pb-5 house_owner_container">
        <div class="sub_title text-center"><h2>House Owners Array</h2></div>
        <div
          v-if="owners.length > 0"
          class="d-flex flex-row w-100 flex-wrap mt-3 justify-content-center"
        >
          <div
            v-for="owner in owners"
            class="col-md-4 mb-2 mr-2"
            style="width: 31%; margin-right: 1%"
          >
            <div v-if="Array.isArray(owner)" class="details_card card mb-2 h-100 p-5">
              <div v-for="detail in owner">
                $person['title'] => {{ detail["title"] }} <br />
                $person['first_name'] => {{ detail["first_name"] ?? "null" }}<br />
                $person['initial'] => {{ detail["initial"] ?? "null" }}<br />
                $person['last_name'] => {{ detail["last_name"] }}<br />
              </div>
            </div>
            <div v-else class="card mb-2 h-100 p-5 details_card">
              $person['title'] => {{ owner["title"] }} <br />
              $person['first_name'] => {{ owner["first_name"] ?? "null" }}<br />
              $person['initial'] => {{ owner["initial"] ?? "null" }}<br />
              $person['last_name'] => {{ owner["last_name"] }}<br />
            </div>
          </div>
        </div>
        <div v-else class="mt-5 text-center">No data to display</div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      file: [],
      errors: [],
      owners: [],
    };
  },
  methods: {
    handleFileUpload(event) {
      this.file = event.target.files[0];
      this.getDataArray();
    },
    // send an api request to get the CSV data array
    getDataArray() {
      this.errors = [];
      const formData = new FormData();
      formData.append("file", this.file);

      this.axios
        .post("api/upload-csv", formData)
        .then((data) => {
          this.owners = data.data.data;
        })
        .catch((error) => {
          if (error && error.response && error.response.data.errors) {
            this.errors = error.response.data.errors;
          }
        });
    },
  },
};
</script>
