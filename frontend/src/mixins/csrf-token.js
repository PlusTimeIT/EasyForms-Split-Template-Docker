const CsrfToken = {
    async mounted(){
        if(!this.$crsfToken.loading && this.$crsfToken.token === false){
            this.$crsfToken.loading = true;
            await this.fetchNewToken();
            
        }
    },
    methods: {
        async fetchNewToken(){
            const _this = this;
            return window.axios.get(this.$microservice.url + "/axios/csrf-cookie")
            .then(function(){
                _this.$crsfToken.loading = false;
                _this.$crsfToken.token = true;
            });
        },
    },
  }

  export { CsrfToken }
