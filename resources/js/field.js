Nova.booting((Vue, router, store) => {
  Vue.component('index-pusher-dynamic-field', require('./components/IndexField'))
  Vue.component('detail-pusher-dynamic-field', require('./components/DetailField'))
  Vue.component('form-pusher-dynamic-field', require('./components/FormField'))
})
