<template>
    <v-app>
        <v-main>
            <v-app-bar
                app
            >
                Geomiq Test Code
            </v-app-bar>
            <v-container fluid fill-height>
                <v-layout justify-center align-center fill-height>
                    <v-flex lg8>
                        <v-layout justify-center column>
                            <h2>Upload An Image</h2>
                            <v-divider></v-divider>
                            <v-text-field
                                label="Title"
                                v-model="image.title"
                            >
                            </v-text-field>
                            <v-file-input
                                name="file" 
                                label="Upload Image"
                                type="file"
                                accept="model/stl"
                                ref="image" 
                                @change="pickFile($event)" 
                            />
                            <v-card class="my-3">
                                <model-stl
                                    v-if="image.filename"
                                    :src="image.filename"
                                ></model-stl>
                                <v-layout justify-center class="pa-5" v-else>
                                    Select An Image
                                </v-layout>
                            </v-card>
                            <v-btn
                                @click="save"
                            >
                                Upload
                            </v-btn>
                        </v-layout>
                    </v-flex>
                </v-layout>
            </v-container>
            <snack-bar></snack-bar>
        </v-main>
    </v-app>
</template>

<script>
import axios from 'axios'

// vue-3d-model allows for a preview image that can be manipulated
import { ModelStl } from 'vue-3d-model';
// eventbus will enable communication with the snackbar
import { EventBus } from '../event'
import SnackBar from './layout/SnackBar.vue'

export default {

    components: {
        ModelStl,
        SnackBar
    },

    data() {
        return {
            title: null,
            image: {
                title: null,
                filename: null
            },
        }
    },

    methods: {
        pickFile(image)
        {
            // turn image data into a base64 string
            let reader = new FileReader();

            reader.readAsDataURL(image);

            reader.onload = e => {    
                this.image.filename = e.target.result
            };
        },
        save()
        {
            axios.post('/api/images',  this.image)
            .then(res => {
                this.image.title = null
                this.$refs.image.value = null
                this.image.filename = null
                EventBus.$emit('snackbar', 'Image Uploaded successfully!', 'green')
            })
            .catch(error => {
                EventBus.$emit('snackbar', 'Image Upload failed!', 'red')
                console.log(error.response)
            })
        }
    }
}
</script>

<style>

</style>