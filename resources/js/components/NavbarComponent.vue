<template>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="menu-nav" @click="sidebarToggle()">
      <span class="fas fa-bars"></span>
      <!-- <button > KLIK</button> -->
    </div>
    <div class="container">
      <a href="#" class="navbar-brand">
        <span class="brand-text font-weight-light">JupiterPOS</span>
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <!-- <li class="nav-item">
            <router-link to="/admin/kasir" class="nav-link">Daftar Menu</router-link>
          </li> -->
          <!-- <li class="nav-item">
            <router-link to="/admin/kasir/makanan" class="nav-link">Makanan</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/admin/kasir/minuman" class="nav-link">Minuman</router-link>
          </li> -->
          <!-- <li class="nav-item">
            <router-link to="/admin/kasir/pembayaran" class="nav-link">Pembayaran</router-link>
          </li> -->
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-5">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" name="cari_menu" v-model="dataCari" type="search" placeholder="Cari Menu" aria-label="Cari Menu" width="100%">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="button" v-on:click="cariItemAct({cari:dataCari,page:1})">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </nav>
</template>

<script>
  import {mapActions,mapGetters} from 'vuex'

	export default {
    data:() => {
      return {
        dataCari:null
      }
    },
    computed: {
      ...mapGetters([
        'cariItem'
      ])
    },
    methods: {
    ...mapActions([
        'cariItemAct',
        'sidebarToggle'
      ])
    }
  }
</script>