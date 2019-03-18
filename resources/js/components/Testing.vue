<template>
  <div class="container">
    <div class="row mt-2">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">View Engagement User</h3>

            <div class="card-tools"></div>
          </div>
          <div class="card-body">Engagement along with assigned user</div>
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
                  v-model="selected"
                  id="user"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('user') }"
                >
                  <option
                    v-for="user in users"
                    :key="user.id"
                    v-bind:value="user.id"
                    v-text="user.name"
                  ></option>
                </select>
                <has-error :form="form" field="user"></has-error>
                <select :options="options" name="test" v-model="selected" multiple=true>

                </select>
                <!-- <v-select v-model="user_id" label="name" :options="option_users"></v-select> -->
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
  const options = {
  apples: 'green',
  bananas: 'yellow',
  orange: 'orange'
}
    return {
      selected: [],
      options,
      select2data: [],
      engagements: {},
      users: {},
      user_id: [],
      expanded: false,
      form: new Form({
        engagement_id: "",
        user_id: ""
      }),

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

    mapUsers() {
      console.log("Engagement id is " + this.form.engagement_id);
      console.log("User id is " + this.selected);
    },

    formatOptions() {
      this.select2data.push({ id: "", text: "Select" });
      for (let key in this.options) {
        this.select2data.push({ id: key, text: this.options[key] });
      }
    },
  },

  created() {
    this.loadEngagements();
    this.loadUsers();
  },

  mounted: function() {
    this.formatOptions();
    let vm = this;
  let select = $("#user")
    $("#engagement").select2({
      placeholder: "Select an Engagement",
      allowClear: true
    });

    $("#user")
      .select2({
        placeholder: "Select an User",
        allowClear: true,
        data: this.select2data
      })
      .on("change", function() {
        vm.$emit("input", select.val());
      });
    select.val(this.value).trigger("change");
  }
};
</script>
<style scoped>
</style>
