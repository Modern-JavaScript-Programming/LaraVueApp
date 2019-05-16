<template>
  <div class="container">
    <div class="row mt-2" v-if="$gate.isSuperAdmin()">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">View Engagement User</h3>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>Engagement</th>
                  <th>Assigned Users</th>
                </tr>
                  <tr v-for="engagement_user in engagements_users" :key="engagement_id">
                  <td>{{engagement_user.name }}</td>
                  <td>( {{ engagement_user.users_count}} )</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Map User to Engagement</h3>

            <div class="card-tools"></div>
          </div>
          <div class="card-body">
            <form @submit.prevent="mapUsers()">
              <div class="form-group">
                <select
                  name="engagement"
                  v-model="form.engagement_id"
                  id="engagement"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('engagement') }"
                >
                  <option
                    v-for="engagement in engagements"
                    :key="engagement.id"
                    v-bind:value="engagement.id"
                    v-text="engagement.name"
                  ></option>
                </select>
                <has-error :form="form" field="engagement"></has-error>
              </div>

              <div class="form-group">
                <select
                  name="user"
                  v-model="form.user_id"
                  multiple="multiple"
                  id="user"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('user') }"
                >
                  <option
                    v-for="user in users"
                    :key="user.id"
                    v-bind:value="user.id"
                    v-text="`${user.first_name} ${user.last_name}`"
                  ></option>
                </select>
                <has-error :form="form" field="user"></has-error>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary">Map User</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      engagements: {},
      engagements_users: {},
      users: {},
      engagement_user: "",
      form: new Form({
        engagement_id: "",
        user_id: []
      })
    };
  },

  methods: {
    loadEngagements() {
      axios
        .get("api/all-engagements")
        .then(({ data }) => (this.engagements = data));
    },

    loadUsers() {
      axios.get("api/all-users").then(({ data }) => (this.users = data));
    },

    loadEngagementUsers(engagement_user_id) {
      axios
        .get("api/engagement-user/" + engagement_user_id)
        .then(({ data }) => (this.users = data));
    },

    loadAllEngagementsUsers() {
      axios
        .get("api/loadAllEngagementsUsers")
        .then(({ data }) => (this.engagements_users = data));
    },

    mapUsers() {
      this.form.user_id = $("#user").select2("val");
      this.form
        .post("api/engagement-user")
        .then(() => {
          //Fire.$emit("AfterCreate");
          toast.fire({
            type: "success",
            title: "Mapping done successfully"
          });
        })
        .catch(() => {
          swal.fire("Failed!", "There was something wrong.", "error");
        });
    }
  },

  created() {
    this.loadEngagements();
    this.loadUsers();
    this.loadAllEngagementsUsers();
  },

  mounted: function() {
    $("#engagement").select2({
      placeholder: "Select an Engagement",
      allowClear: true
    });

    $("#engagement").on(
      "select2:select",
      function(e) {
        let _response = e.params.data;
        this.loadEngagementUsers(_response.id);
        this.form.engagement_id = _response.id;
      }.bind(this)
    );

    $("#user").select2({
      placeholder: "Select an User",
      maximumSelectionLength: 4,
      allowClear: true
    });
  }
};
</script>
<style scoped>
</style>
