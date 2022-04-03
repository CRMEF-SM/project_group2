<template>
  <div>
    <nav>
      <div class="logo">
        <img src="./assets/logo.png" alt="logo" />
      </div>
      <h3>School Name</h3>
    </nav>
    <div v-if="waiting_list.length > 0">
      <div class="sidebar">
        <div class="sidebar-title">
          <i class="fas fa-clock"></i> Waiting List
        </div>
        <div class="box" v-for="info in waiting_list" :key="info">
          <div class="users">
            <img
              :src="`http://localhost/images/${info.parent.photo}`"
              alt="image-student"
              id="img-student"
            />
          </div>
        </div>
      </div>
      <div class="container" v-if="this.waiting_list[this.i]">
        <div class="main-box parent">
          <!-- :src="this.infosParent[this.i].url" -->
          <img
            :src="`http://localhost/images/${this.waiting_list[0].parent.photo}`"
            alt="image-parent"
            id="parent-image"
          />
          <h2 class="heading-name" id="parent-name" ref="parentname">
            {{ this.waiting_list[0].parent.first_name }}
            {{ this.waiting_list[0].parent.last_name }}
          </h2>
          <h3 class="heading-work" id="parent-city">
            {{ this.waiting_list[0].parent.adresse }}
          </h3>
        </div>
        <div class="main-box student">
          <img
            :src="`http://localhost/images/${this.waiting_list[0].student.photo}`"
            alt="image-student"
            id="child-image"
          />
          <h2 class="heading-name" id="child-name">
            {{ this.waiting_list[0].student.first_name }}
            {{ this.waiting_list[0].student.last_name }}
          </h2>
          <h3 class="heading-work" id="child-city">
            {{ this.waiting_list[0].student.adresse }}
          </h3>
        </div>
      </div>
    </div>
    <div v-else>
      <h1 class="nothing-message">
      nothing here :)
      </h1>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import axios from "axios";
// import VueAxios from 'vue-axios'
export default {
  name: "App",
  data() {
    return {
      waiting_list: [],
      i: 0,
    };
  },
  mounted() {},
  async created() {
    await this.handleData();
  },
  methods: {
    async handleData() {
      try {
        var waiting_list = await axios.get("http://localhost/api/waiting_list");
        this.waiting_list = waiting_list.data;
        setTimeout(() => {
          this.handleData();
        }, 2000);
      } catch (err) {
        console.log(err);
      }
    },
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  margin: 0px;
  padding: 0px;
  box-sizing: border-box;
}
nav {
  display: flex;
  justify-content: space-around;
  align-items: center;
  height: 70px;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  background-color: #eee;
  border-bottom: 3px solid rgba(192, 192, 192, 1);
}
nav .logo img {
  width: 50px;
  height: 40px;
}
nav h3 {
  font-family: "Dancing Script", cursive;
  font-size: 27px;
  font-weight: 600;
  color: #b42dfd;
}
.sidebar {
  position: absolute;
  width: 18%;
  top: 73px;
  left: 0;
  background-color: white;
  overflow-y: auto;
}
.sidebar .sidebar-title {
  width: 100%;
  min-height: 10%;
  color: #46e097;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  font-weight: bold;
  letter-spacing: 1px;
  font-size: 22px;
  margin-top: 20px;
  /* border-bottom: 1px solid #146ebe; */
}
.sidebar .users {
  display: flex;
  justify-content: center;
  align-items: center;
  align-content: center;
  padding: 0px 10px;
  margin: 10px 0;
}
.sidebar .users img {
  height: 80px;
  width: 80px;
  border-radius: 50%;
  border: 1px solid #b42dfd;
  margin-bottom: 20px;
}
.sidebar .users i {
  margin-right: 10px;
}
.container {
  margin-top: 150px;
  display: flex;
  justify-content: center;
  gap: 100px;
  width: 82%;
  margin-left: auto;
}
.container .main-box:last-child {
  box-shadow: 2px 4px 2px 4px rgba(187, 98, 235, 0.8);
}
.main-box {
  width: 300px;
  max-width: 30%;
  box-shadow: 2px 4px 2px 4px rgba(70, 224, 151, 0.65);
  border-radius: 10px;
  text-align: center;
  padding: 20px 0;
}
.container .main-box:last-child .heading-work {
  color: #a600ff;
  font-weight: 500;
}
.container .main-box img {
  width: 200px;
  max-width: 60%;
  object-fit: cover;
  border-radius: 50%;
  border: 5px solid rgba(70, 224, 151, 0.65);
}
.container .main-box:last-child img {
  border: 5px solid rgba(187, 98, 235, 0.8);
}

.heading-name {
  margin: 10px 0;
}

.heading-work {
  color: #46e097;
  font-weight: 500;
  margin: 3px 0;
}
p {
  padding: 0 20px;
  margin-bottom: 25px;
}

.follow_btn {
  text-decoration: none;
  background: #46e097;
  color: #fff;
  padding: 10px 20px;
  border-radius: 20px;
  box-shadow: 2px 2px 1px 1px rgba(70, 224, 151, 0.65);
}

.follow_btn:hover {
  color: #46e097;
  background: #daf9f6;
  font-weight: 600;
}
.nothing-message {
  font-size: 30px;
  color: #888;
  text-align: center;
  margin-top: 250px;
}
</style>
