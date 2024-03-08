<template>
  <div>
    <div v-if="type == 'employee'" class="d-flex justify-content-between">
      <div class="w-50 p-3 d-flex align-items-center">
        <div class="ml-5">
          <h4 class="mb-3">Post your job on the go</h4>
          <p>Download our app to get instant job updates, contact/chat to trader anywhere, anytime.</p>
          <div class="d-flex mt-5">
            <a @click="external('https://apple.com')" class="mr-3"><img src="/images/apple-store.svg" alt="App store"
                width="120" /></a>
            <a @click="external('https://play.google.com')"><img src="/images/google-play.svg" alt="Google play"
                width="120" /></a>
          </div>
        </div>
      </div>
      <div class="w-50 pt-5 text-center in-phone-d-none">
        <img src="/images/about3.png" alt="" width="270">
      </div>
    </div>

    <div v-if="type == 'employer'" class="d-flex justify-content-between">
      <div class="w-50 p-3 d-flex align-items-center">
        <div class="ml-5">
          <h4 class="mb-3">Manage your job on the go</h4>
          <p>Download our app to get instant job updates, chat to customers anywhere, anytime.</p>
          <div class="d-flex mt-5">
            <a @click="external('https://apple.com')" class="mr-3"><img src="/images/apple-store.svg" alt="App store"
                width="120" /></a>
            <a @click="external('https://play.google.com')"><img src="/images/google-play.svg" alt="Google play"
                width="120" /></a>
          </div>
        </div>
      </div>
      <div class="w-50 pt-5 text-center  in-phone-d-none">
        <img src="/images/about3.png" alt="" width="270">
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ['type'],
  methods: {
    external(path) {
      window.open(path, "_blank");
    },
  },
};
</script>
<style lang="scss" scoped>
a {
  img:hover {
    cursor: pointer;
  }
}
</style>
