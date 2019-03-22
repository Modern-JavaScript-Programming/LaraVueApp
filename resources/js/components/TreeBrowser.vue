<template>
  <div>
    <div class="node" @click="expanded = !expanded">
      {{root.name}}
    <span>{{ expanded ? '&#9660;' : '&#9658;'}}</span>
    </div>
      <ol v-for="rootchild in root.children" :key="rootchild.name" v-if="expanded">
        <h3>{{rootchild.name}}</h3>
        <ul v-for="subchild in rootchild.children" :key="subchild.name" :depth="depth + 1">
          <li>
            <h4>{{subchild.name}}</h4>
          </li>
        </ul>
      </ol>
  </div>
</template>
<script>
export default {
  data() {
    return {
      root: {
        name: "Engagements",
        children: [
          {
            name: "Web",
            children: [
              {
                name: "user1"
              },
              {
                name: "user2"
              },
              {
                name: "user5"
              }
            ]
          },
          {
            name: "Design",
            children: [
              {
                name: "user2"
              },
              {
                name: "user3"
              }
            ]
          },
          {
            name: "Editorial",
            children: [
              {
                name: "user1"
              },
              {
                name: "user2"
              },
              {
                name: "user4"
              }
            ]
          }
        ]
      },
      depth: {
        type: Number,
        default: 0
      },
      expanded: false
    };
  }
};
</script>
<style scoped>
</style>
