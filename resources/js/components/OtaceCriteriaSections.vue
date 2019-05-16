<template>
  <div class="container">
    <div class="row mt-2">
      <div class="col-md-12">
        <!-- Section Listing -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Otace Criteria Sections</h3>
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
                  <th>Section Name</th>
                  <th>Modify</th>
                </tr>
                <tr
                  v-for="otace_criteria_section in otace_criteria_sections.data"
                  :key="otace_criteria_section.id"
                >
                  <td>{{otace_criteria_section.section_name}}</td>
                  <td>
                    <a href="#" @click="editModal(otace_criteria_section)">
                      <i class="fa fa-edit blue"></i>
                    </a>
                    /
                    <a
                      href="#"
                      @click="deleteSection(otace_criteria_section.id)"
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
            <pagination :data="otace_criteria_sections" @pagination-change-page="getResults"></pagination>
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
            <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Section</h5>
            <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Section</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateSection() : createSection()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.section_name"
                  type="text"
                  name="section_name"
                  placeholder="Section Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('section_name') }"
                >
                <has-error :form="form" field="section_name"></has-error>
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
        otace_criteria_sections: {},
        form: new Form({
        id: "",
        section_name: "",
      })
    };
  },

  methods: {

       getResults(page = 1) {
        axios.get('api/otace-criteria-section?page=' + page)
            .then(response => {
                this.otace_criteria_sections = response.data;
            });
        },

      newModal() {
        this.editmode = false;
        this.form.reset()
        this.form.clear()
        $('#addNew').modal('show');
    },

      editModal(otace_criteria_section) {
      this.editmode = true;
      this.form.reset()
      $('#addNew').modal('show');
      this.form.fill(otace_criteria_section);
    },

      loadOtaceCriteriaSections() {
        axios.get("api/otace-criteria-section").then(({ data }) => (this.otace_criteria_sections = data));
    },

    createSection() {
        this.$Progress.start();
        this.form.post('api/otace-criteria-section')
        .then(()=>{
            Fire.$emit('AfterCreate');
            $('#addNew').modal('hide')

            toast.fire({
                type: 'success',
                title: 'New Section is successfully created'
                })
            this.$Progress.finish();

        })
        .catch(()=>{
          this.$Progress.fail();
        })
    },

    updateSection() {
        this.$Progress.start();
        this.form.put('api/otace-criteria-section/' + this.form.id)
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

    deleteSection(id) {
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
              this.form.delete('api/otace-criteria-section/' + id).then(()=>{
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
          axios.get('api/findSections?q=' + query)
          .then((data) => {
              this.otace_criteria_sections = data.data
          })
          .catch(() => {
          })
      })
      this.loadOtaceCriteriaSections()

      Fire.$on('AfterCreate',() => {
      this.loadOtaceCriteriaSections();
    });
  }
}
</script>
