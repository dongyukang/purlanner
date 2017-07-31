<template>
    <div class="alert alert-flash"
         :class="'alert-'+level"
         role="alert"
         v-show="show">
         <strong>{{ head }}</strong> {{ body }}
    </div>
</template>

<script>
    export default {
        props: ['message', 'type'],
        data() {
            return {
                head: '',
                body: '',
                level: this.type,
                show: false
            }
        },
        mounted() {
            if (this.message) {
                this.flashSession(this.message);
            }

            window.events.$on(
                'flash', data => this.flash(data)
            );
        },
        methods: {
            getHead() {
              if (this.type == 'danger') {
                return 'Oh Snap!';
              } else if (this.type == 'info') {
                return 'Success!';
              }
            },

            flashSession(message) {
              this.head = this.getHead();
              this.body = message;
              this.level = this.level;
              this.show = true;
              this.hide();
            },

            flash(data) {
                this.body = data.message;
                this.level = data.level;
                this.show = true;
                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000);
            }
        }
    };
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
