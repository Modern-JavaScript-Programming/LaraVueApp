<template>
  <div class="container">
    <div class="row mt-2">
      <div class="col-md-12">
        <!-- Section Listing -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Otace Criteria Sub Sections</h3>
            <div class="card-tools">
              <button
                class="btn btn-success"
                data-toggle="modal"
                data-target="#addNew"
                @click="newModal"
              >
                Add New
                <i class="fas fa-user-plus fa-fw"></i>
              </button>
            </div>
          </div>
          <!---card body -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>Subsection Name</th>
                  <th>Subsection Description</th>
                  <th>Rating (Y/N)</th>
                  <th>Modify</th>
                </tr>
                <tr
                  v-for="otace_criteria_subsection in otace_criteria_subsections.data"
                  :key="otace_criteria_subsection.id"
                >
                  <td>{{otace_criteria_subsection.subsection_name}}</td>
                  <td>{{otace_criteria_subsection.subsection_desc}}</td>
                  <td>{{otace_criteria_subsection.rating}}</td>
                  <td>
                    <a href="#" @click="editModal(otace_criteria_subsection)">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    /
                    <a
                      href="#"
                      @click="deleteSubsection(otace_criteria_subsection.id)"
                    >
                      <i class="fa fa-trash red"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- End of card body -->
          <!-- card footer -->
          <div class="card-footer">
            <pagination :data="otace_criteria_subsections" @pagination-change-page="getResults"></pagination>
          </div>
          <!-- end of card footer -->
        </div>
        <!-- Section Listing End -->
      </div>
    </div>
    <!-- Modal Form Start -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Subsection</h5>
            <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Subsection</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateSubsection() : createSubsection()">
            <div class="modal-body">
              <div class="form-group">
                <select
                  name="otace_criteria_sections"
                  v-model="form.section_id"
                  id="otace_criteria_sections"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('otace_criteria_sections') }"
                >
                  <option
                    v-for="otace_criteria_section in otace_criteria_sections.data"
                    :key="otace_criteria_section.id"
                    :value="otace_criteria_section.id"
                  >{{otace_criteria_section.section_name }}</option>
                </select>
                <has-error :form="form" field="section_id"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.subsection_name"
                  type="text"
                  name="subsection_name"
                  placeholder="Subsection Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('subsection_name') }"
                >
                <has-error :form="form" field="subsection_name"></has-error>
              </div>
              <div class="form-group">
                <textarea
                  v-model="form.subsection_desc"
                  type="text"
                  name="subsection_desc"
                  placeholder="Subsection Description"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('subsection_desc') }"
                ></textarea>
                <has-error :form="form" field="subsection_desc"></has-error>
              </div>

              <div class="form-group">
                <label class="form-check-label" for="Rating">Rating</label>
                <div class="custom-control custom-radio custom-control-inline">
                  <input
                    v-model="form.rating"
                    type="radio"
                    id="customRadioInline1"
                    name="customRadioInline1"
                    class="custom-control-input"
                    :class="{ 'is-invalid': form.errors.has('rating') }"
                    value="Y"
                  >
                  <label
                    class="custom-control-label"
                    for="customRadioInline1"
                  >Yes</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input
                    v-model="form.rating"
                    type="radio"
                    id="customRadioInline2"
                    name="customRadioInline1"
                    class="custom-control-input"
                    :class="{ 'is-invalid': form.errors.has('rating') }"
                    value="N"
                  >
                  <label
                    class="custom-control-label"
                    for="customRadioInline2"
                  >No</label>
                </div>
                <has-error :form="form" field="rating"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End of Modal Form -->
  </div>
</template>

<<script>
export default {
  data() {
    return {
        editmode: false,
        otace_criteria_sections:{},
        otace_criteria_subsections: {},
        form: new Form({
        id: "",
        section_id:"",
        subsection_name: "",
        subsection_desc:"",
        rating:""
      })
    };
  },

  methods: {

       getResults(page = 1) {
        axios.get('api/otace-criteria-subsection?page=' + page)
            .then(response => {
                this.otace_criteria_subsections = response.data;
            });
        },

      newModal() {
        this.editmode = false;
        this.form.reset()
        this.form.clear()
        $('#addNew').modal('show');
    },

      editModal(otace_criteria_subsections) {
      this.editmode = true;
      this.form.reset()
      $('#addNew').modal('show');
      this.form.fill(otace_criteria_subsections);
    },

      loadOtaceCriteriaSections() {
        axios.get("api/otace-criteria-section").then(({ data }) => (this.otace_criteria_sections = data));
    },

      loadOtaceCriteriaSubsections() {
        axios.get("api/otace-criteria-subsection").then(({ data }) => (this.otace_criteria_subsections = data));
    },

    createSubsection() {
        this.$Progress.start();
        this.form.post('api/otace-criteria-subsection')
        .then(()=>{
            Fire.$emit('AfterCreate');
            $('#addNew').modal('hide')

            toast.fire({
                type: 'success',
                title: 'New Subsection is successfully created'
                })
            this.$Progress.finish();

        })
        .catch(()=>{
          this.$Progress.fail();
        })
    },

    updateSubsection() {
        this.$Progress.start();
        this.form.put('api/otace-criteria-subsection/' + this.form.id)
        .then(() => {
            // success
            $('#addNew').modal('hide');
              swal.fire(
                'Updated!',
                'Information has been updated.',
                'success'
                )
                this.$Progress.finish();
                Fire.$emit('AfterCreate');
        })
        .catch(() => {
            this.$Progress.fail();
        });
    },

    deleteSubsection(id) {
      swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {

      // Send request to the server
        if (result.value) {
              this.form.delete('api/otace-criteria-subsection/' + id).then(()=>{
                      swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                      )
                  Fire.$emit('AfterCreate');
              }).catch(()=> {
                  swal.fire("Failed!", "There was something wrong.", "error");
              });
        }
        })
    }

  },
  created() {
          Fire.$on('searching',() => {
          let query = this.$parent.search;
          axios.get('api/findSubsections?q=' + query)
          .then((data) => {
              this.otace_criteria_subsections = data.data
          })
          .catch(() => {
          })
      })
      this.loadOtaceCriteriaSections()
      this.loadOtaceCriteriaSubsections()

      Fire.$on('AfterCreate',() => {
      this.loadOtaceCriteriaSubsections()
    });
  }
}
</script>
