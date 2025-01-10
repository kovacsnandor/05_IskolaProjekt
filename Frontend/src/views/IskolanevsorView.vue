<template>
  <div>
    <h1>Iskolanévsor</h1>
    <div v-for="osztaly in rowsOsztalyok" :key="osztaly.osztalyNev">
      <h2>{{ osztaly.osztalyNev }}</h2>
      <ul>
        <li v-for="(nev, index) in osztaly.nevek" :key="index">
          {{ nev }}
        </li>
      </ul>
    </div>
  </div>

</template>

<script>
import { BASE_URL } from "../helpers/baseUrls";
import axios from "axios";
export default {
  data() {
    return {
      urlApi: BASE_URL,
      rowsOsztalyok: []
    }
  },
  mounted(){
    this.OsztalynevsorObj()
  },
  methods: {
    async OsztalynevsorObj(){
      const url = `${this.urlApi}/queryOsztalynevsorokObj`;
      const response = await axios.get(url);
      this.rowsOsztalyok = response.data.data;
      console.log(this.rowsOsztalyok);
    }
  }
};
</script>

<style>
</style>