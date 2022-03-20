<template>
     <nav>
        <div class="logo">
            <img src="./assets/logo.png" alt="logo">
        </div>
        <h3>School Name</h3>
    </nav>
        <div class="sidebar">
        <div class="sidebar-title"><i class="fas fa-clock"></i> Waiting List</div>
        <div class="box" v-for="info in infosChildren" :key="info.cin">
          <div class="users" v-if="info.waitingState">
              <img v-bind:src="require(`${info.url}`)" alt="image-student" id="img-student">       
          </div>
        </div>
    </div>

    <div class="container">
        <div class="main-box parent">
          <!-- :src="this.infosParent[this.i].url" -->
            <img  :src="require(`${this.infosParents[this.i].url}`)" alt="image-parent" id="parent-image">
            <h2 class="heading-name" id="parent-name" ref="parentname">{{ this.infosParents[this.i].name }}</h2>
            <h3 class="heading-work" id="parent-city">{{ this.infosParents[this.i].city }}</h3>
        </div>
        <div class="main-box student">
            <img :src="require(`${this.infosChildren[this.i].url}`)" alt="image-student" id="child-image">
            <h2 class="heading-name" id="child-name">{{ this.infosChildren[this.i].name }}</h2>
            <h3 class="heading-work" id="child-city">{{ this.infosChildren[this.i].city }}</h3>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
// import VueAxios from 'vue-axios'
export default {
  name: 'App',
  data(){
      return{
      infosParents: [],
      infosChildren: [],
      i: 0
    }
  },
  mounted(){
    setInterval(() => {
      this.handleData()
    }, 2000)
  }
  ,
  async created(){
    try{
      const res = await axios.get("http://localhost:3000/parents");
      const secondeRes = await axios.get("http://localhost:3000/students")
      this.infosParents = res.data;
      this.infosChildren = secondeRes.data
    }catch(err){
      console.log(err);
    }
  },
  methods: {
    handleData(){
      if(this.i === this.infosParents.length){
        this.i = 0
        return
      }
      this.infosChildren[this.i].waitingState = false
      this.i = this.i + 1
  }
  }
}
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
    background-color: #EEE;
    border-bottom: 3px solid rgba(192, 192, 192,1);
}
nav .logo img {
    width: 50px;
    height: 40px;
}
nav h3 {
    font-family: 'Dancing Script', cursive;
    font-size: 27px;
    font-weight: 600;
    color: #b42dfd;
}
.sidebar {
  position: absolute;
  width: 18%;
  height: 720px;
  top: 73px;
  left: 0;
  background-color: white;
  overflow-y: scroll;
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
.sidebar .users img{
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
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-40%,-50%);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 100px;
}
.container .main-box:last-child {
    box-shadow: 2px 4px 2px 4px rgba(187, 98, 235, 0.8);
}
.main-box {
    width: 300px;
    height: 300px;
    box-shadow: 2px 4px 2px 4px rgba(70, 224, 151, 0.65);
    border-radius: 10px;
    text-align: center;
    padding: 20px 0;
}
.container .main-box:last-child .heading-work {
    color: #A600FF;
    font-weight: 500;
}
.container .main-box img{
  height: 200px;
  width: 200px;
  object-fit: cover;
  border-radius: 50%;
  border: 5px solid rgba(70, 224, 151, 0.65);
}
.container .main-box:last-child img{
  border: 5px solid rgba(187, 98, 235, 0.8);
}

.heading-name {
 margin: 10px 0;   
}

.heading-work {
    color: #46E097;
    font-weight: 500;
    margin: 3px 0;
}
p {
    padding: 0 20px;
    margin-bottom: 25px;
}

.follow_btn {
    text-decoration: none;
    background: #46E097;
    color: #fff;
    padding: 10px 20px;
    border-radius: 20px;
    box-shadow: 2px 2px 1px 1px rgba(70, 224, 151, 0.65);
}

.follow_btn:hover{
    color: #46E097;
    background: #DAF9F6;
    font-weight: 600;
}
</style>