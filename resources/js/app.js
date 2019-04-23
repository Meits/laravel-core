

window.Vue = require('vue');
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css'

import axios from 'axios'
import VueAxios from 'vue-axios'

Vue.use(VueAxios, axios)

Vue.use(Vuetify)

Vue.axios.defaults.headers.common = {
    'X-CSRF-TOKEN': Laravel.csrfToken
};

const app = new Vue({
    el: '#app',
        data: () => ({
            valid: false,
            contactValid: false,
            contactFormSendSuccess: false,
            contact : {
                firstname: '',
                lastname: '',
                phone: '',
                email: '',
                text: '',
            },
            validRules : {
                nameRules: [
                    v => !!v || 'Name is required',
                    v => v.length <= 10 || 'Name must be less than 10 characters'
                ],

                emailRules: [
                    v => !!v || 'E-mail is required',
                    v => /.+@.+/.test(v) || 'E-mail must be valid'
                ],
                emptyRules: [
                    v => !!v || 'Field is required',
                ],

            }

        }),

        methods : {
            contactSend : function() {
                this.contactValid = false;
                if(!this.valid) {
                    this.contactValid = true;
                    return false;
                }
                Vue.axios.post('api/contacts',this.contact
                ).then((response) => {
                    if(response.data.status == "success") {
                        this.contact.email = "";
                        this.contact.firstname = "";
                        this.contact.lastname = "";
                        this.contact.phone = "";
                        this.contact.text = "";

                        this.contactFormSendSuccess = true;

                    }
                })
            }
        }
});
