<template>
  <div>
    <v-snackbar
      v-model="snackbar.showing"
      :color="snackbar.color"
    >
      {{snackbar.text}}

      <v-btn text @click="snackbar.showing = false">
        Close
      </v-btn>
    </v-snackbar>
  </div>
</template>

<script>
import {EventBus} from '../../event'

export default {

    data() {
        return {
            snackbar: {
                showing: false,
                text: null,
                color: 'green'
            }
        }
    },

    mounted()
    {
        EventBus.$on('snackbar', (text, color) => {
            console.log(text)
            this.snackbar.showing = true
            this.snackbar.text = text
            this.snackbar.color = color
        })
    }

}
</script>

<style lang="scss" scoped>
</style>