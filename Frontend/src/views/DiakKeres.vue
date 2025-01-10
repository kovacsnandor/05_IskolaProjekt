<template>
  <h1>Diák kereső</h1>
  <div class="d-flex" role="search">
    <input
      class="form-control me-2"
      type="search"
      placeholder="Search"
      aria-label="Search"
      v-model="searchInput"
    />
    <button class="btn btn-outline-success" type="submit" @click="onClickSearch()">Search</button>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">osztalyId</th>
        <th scope="col">nev</th>
        <th scope="col">neme</th>
        <th scope="col">született</th>
        <th scope="col">helység</th>
        <th scope="col">ösztöndij</th>
        <th scope="col">átlag</th>
        <th scope="col">osztály név</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="row in rows" :key="row.id">
        <td>{{ row.id }}</td>
        <td>{{ row.osztalyId }}</td>
        <td>{{ row.nev }}</td>
        <td>{{ row.neme }}</td>
        <td>{{ row.szuletett }}</td>
        <td>{{ row.helyseg }}</td>
        <td>{{ row.osztondij }}</td>
        <td>{{ row.atlag }}</td>
        <td>{{ row.osztalynev }}</td>
      </tr>
    </tbody>
  </table>
</template>
  
  <script>
import { BASE_URL } from "../helpers/baseUrls";
import axios from "axios";

export default {
  data() {
    return {
      urlApi: BASE_URL,
      rows: [],
      searchInput: null,
      searchWord: null,
    };
  },
  mounted() {
    this.getDiaks();
  },
  watch:{
    
  },
  methods: {
    async getDiaks() {
      const url = `${BASE_URL}/queryDiakKeres/${this.searchWord}`;
      const headers = {
        Accept: "application/json",
      };
      const response = await axios.get(url, headers);
      this.rows = response.data.data;
      console.log("válasz", this.rows);
    },
    onClickSearch(){
      this.searchWord = this.searchInput;
      this.getDiaks();
    }
  },
};
</script>
  
  <style>
</style>