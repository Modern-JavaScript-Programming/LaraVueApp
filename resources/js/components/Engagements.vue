<template>
  <div class="container">
    <div class="row mt-2">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Engagement Management</h3>

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
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Registered At</th>
                  <th>Modify</th>
                </tr>
                <tr v-for="engagement in engagements.data" :key="engagement.id">
                  <td>{{engagement.name}}</td>
                  <td>{{engagement.status | upText}}</td>
                  <td>{{engagement.created_at | myDate}}</td>
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
          <!-- /.card-body -->
          <div class="card-footer">
            <pagination :data="engagements" @pagination-change-page="getResults"></pagination>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Modal -->
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
                    <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Engagement</h5>
                    <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Engagement</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateEngagement() : createEngagement()">
          <div class="modal-body">
            <div class="form-group">
              <input
                v-model="form.name"
                type="text"
                name="name"
                placeholder="Engagement Name"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('name') }"
              >
              <has-error :form="form" field="name"></has-error>
            </div>

            <div class="form-group">
              <select
                name="status"
                v-model="form.status"
                id="status"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('status') }"
              >
                <option value>Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
              </select>
              <has-error :form="form" field="status"></has-error>
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
  </div>
</template>

<script>
export default {
  data() {

    return {
      editmode: false,
      engagements : {},
      form: new Form({
        id: "",
        name: "",
        status: ""
      })
    };
  },

  methods: {

    getResults(page = 1) {
                axios.get('api/engagement?page=' + page)
                    .then(response => {
                        this.engagements = response.data;
                    });
        },
    newModal(){
      this.editmode = false;
      this.form.reset()
      this.form.clear()
      $('#addNew').modal('show');
    },

    editModal(engagement){
      this.editmode = true;
      this.form.reset()
      $('#addNew').modal('show');
      this.form.fill(engagement);
    },

    loadEngagements() {
      axios.get("api/engagement").then(({ data }) => (this.engagements = data));
    },

    createEngagement(){
        this.$Progress.start();
        this.form.post('api/engagement')
        .then(()=>{
            Fire.$emit('AfterCreate');
            $('#addNew').modal('hide')

            toast.fire({
                type: 'success',
                title: 'Engagement Created in successfully'
                })
            this.$Progress.finish();

        })
        .catch(()=>{
          this.$Progress.fail();
        })
    },

    updateEngagement(){
        this.$Progress.start();
        this.form.put('api/engagement/' + this.form.id)
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
    deleteEngagement(id){
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
              this.form.delete('api/engagement/' + id).then(()=>{
                      swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                      )
                  Fire.$emit('AfterCreate');
              }).catch(()=> {
                  swal("Failed!", "There was something wronge.", "warning");
              });
        }
        })
    },

  },

  created() {
            Fire.$on('searching',() => {
                let query = this.$parent.search;
                axios.get('api/findEngagement?q=' + query)
                .then((data) => {
                    this.engagements = data.data
                })
                .catch(() => {
                })
            })
           this.loadEngagements();
           Fire.$on('AfterCreate',() => {
               this.loadEngagements();
           });
  }
};
</script>
