import Vue from 'vue'

Vue.filter('formatRupiah', (money) => {
    let val = (money/1).toFixed(2).replace('.', ',')
    return 'Rp. '+val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
})

Vue.filter('formatDate', (date) => {
	const d = new Date(date)
	const da = new Intl.DateTimeFormat('id', { day: '2-digit' }).format(d)
	const mo = new Intl.DateTimeFormat('id', { month: 'long' }).format(d)
	const ye = new Intl.DateTimeFormat('id', { year: 'numeric' }).format(d)

	return `${da} ${mo} ${ye}`
})