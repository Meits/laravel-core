<div>

    <v-flex xs12 class="my-3">
        <div class="text-xs-center">
            <h1 class="headline">{{$page->titleH1}}</h1>
            <span class="subheading">
                {!! $page->text !!}
              </span>
        </div>
    </v-flex>

    <v-form v-model="valid">
        <v-alert
                :value="contactValid"
                type="warning"
        >
            Error validation.
        </v-alert>
        <v-container>
            <v-layout>
                <v-flex
                        xs12
                        md3
                >
                    <v-text-field
                            v-model="contact.firstname"
                            :rules="validRules.nameRules"
                            :counter="10"
                            label="First name"
                            required
                    ></v-text-field>
                </v-flex>

                <v-flex
                        xs12
                        md3
                >
                    <v-text-field
                            v-model="contact.lastname"
                            :rules="validRules.nameRules"
                            :counter="10"
                            label="Last name"
                            required
                    ></v-text-field>
                </v-flex>

                <v-flex
                        xs12
                        md3
                >
                    <v-text-field
                            v-model="contact.email"
                            :rules="validRules.emailRules"
                            label="E-mail"
                            required
                    ></v-text-field>
                </v-flex>

                <v-flex
                        xs12
                        md3
                >
                    <v-text-field
                            v-model="contact.phone"
                            required
                            :rules="validRules.emptyRules"
                            label="Phone"
                    ></v-text-field>
                </v-flex>
            </v-layout>


            <v-layout>
                <v-flex xs12>
                    <v-textarea
                            v-model="contact.text"
                            label="Text"
                            required
                            :rules="validRules.emptyRules"
                            value=""
                            hint="Введите сообщение"
                    ></v-textarea>
                </v-flex>
            </v-layout>

            <v-layout>
                <v-btn @click="contactSend" color="success">Success</v-btn>
            </v-layout>

            <v-alert
                    :value="contactFormSendSuccess"
                    type="success"
            > Thank you! We will get in touch with you shortly!
            </v-alert>


        </v-container>
    </v-form>

</div>