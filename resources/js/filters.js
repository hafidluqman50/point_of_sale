import Vue from 'vue'

Vue.filter('formatRupiah', (money) => {
    let val = (money/1).toFixed(2).replace('.', ',')
    return 'Rp. '+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
})