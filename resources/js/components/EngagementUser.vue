<template>
  <div class="container">
    <div class="row mt-2">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">View Engagement User</h3>

            <div class="card-tools"></div>
          </div>
          <div class="card-body">
            Engagement along with assigned user
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Add Engagement User</h3>

            <div class="card-tools"></div>
          </div>
          <div class="card-body">All will be written here</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  data() {
    return {
      engagement_users: {},
      expanded: false
    };
  },

  methods: {
    loadEngagementUser() {
      axios
        .get("api/engagement-user")
        .then(({ data }) => (this.engagement_users = data));
    },

  },
  created() {
    this.loadEngagementUser();
  },
};
</script>
<style scoped>
</style>
