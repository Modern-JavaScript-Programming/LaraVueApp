<template>
  <div class="container">
    <div class="row mt-2">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Otace Criteria Sections</h3>
            <div class="card-tools">
              <button
                class="btn btn-success"
                data-toggle="modal"
                data-target="#addNew"
                <!-- @click="newModal" -->
              >
                Add New
                <i class="fas fa-user-plus fa-fw"></i>
              </button>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>Section Name</th>
                  <th>Modify</th>
                </tr>
                <tr v-for="otace_criteria_section in otace_criteria_sections.data" :key="otace_criteria_section.id">
                  <td>{{otace_criteria_section.section_name}}</td>
                  <td>
                    <a href="#" @click="editModal(engagement)">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    /
                    <a href="#" @click="deleteEngagement(engagement.id)">
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<<script>
export default {
  data() {
    return {
        editmode: false,
        otace_criteria_sections: {},
        form: new Form({
        id: "",
        section_name: "",
      })
    };
  },

  methods: {
      loadOtaceCriteriaSections() {
        axios.get("api/otace-criteria-section").then(({ data }) => (this.otace_criteria_sections = data));
    },
  },
  created() {
    this.loadOtaceCriteriaSections()
  }
}
</script>
